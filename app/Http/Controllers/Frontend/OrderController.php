<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    private function getSessionId()
    {
        if (Auth::check()) {
            return Auth::id();
        }

        if (!Session::has('cart_session_id')) {
            Session::put('cart_session_id', uniqid('cart_', true));
        }

        return Session::get('cart_session_id');
    }

    private function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with('product')->where('user_id', Auth::id())->get();
        }

        return Cart::with('product')->where('session_id', $this->getSessionId())->get();
    }

    private function checkoutRules(bool $includePaymentMethod = true): array
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'pincode' => 'required|string|max:20',
        ];

        if ($includePaymentMethod) {
            $rules['payment_method'] = ['required', 'string', Rule::in(['cod', 'razorpay'])];
            $rules['razorpay_payment_id'] = 'nullable|string|max:255';
            $rules['razorpay_order_id'] = 'nullable|string|max:255';
            $rules['razorpay_signature'] = 'nullable|string';
        }

        return $rules;
    }

    private function validateCartForCheckout($cartItems): void
    {
        if ($cartItems->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        foreach ($cartItems as $item) {
            if (!$item->product) {
                throw ValidationException::withMessages([
                    'cart' => 'One of the cart items is no longer available.',
                ]);
            }

            if ($item->product->quantity < $item->quantity) {
                throw ValidationException::withMessages([
                    'cart' => "Product '{$item->product->name}' is out of stock.",
                ]);
            }
        }
    }

    private function calculateCartSummary($cartItems): array
    {
        $subtotal = (float) $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return [
            'subtotal' => round($subtotal, 2),
            'discount' => 0,
            'shipping' => 0,
            'tax' => 0,
            'total' => round($subtotal, 2),
            'amount_in_paise' => (int) round($subtotal * 100),
        ];
    }

    private function cartSignature($cartItems): string
    {
        $payload = $cartItems
            ->sortBy('id')
            ->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => (int) $item->quantity,
                    'price' => number_format((float) $item->price, 2, '.', ''),
                    'size' => $item->size,
                    'color' => $item->color,
                ];
            })
            ->values()
            ->all();

        return hash('sha256', json_encode($payload));
    }

    private function razorpayConfig(): array
    {
        return [
            'key' => (string) config('services.razorpay.key'),
            'secret' => (string) config('services.razorpay.secret'),
            'currency' => (string) config('services.razorpay.currency', 'INR'),
        ];
    }

    private function resolveCheckoutUser(array $validated): User
    {
        if (Auth::check()) {
            return Auth::user();
        }

        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            if ($user->isAdmin()) {
                throw ValidationException::withMessages([
                    'email' => 'This email belongs to an admin account. Please use another email for checkout.',
                ]);
            }

            $user->update([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'type' => User::TYPE_USER,
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'country' => $validated['country'],
                'pincode' => $validated['pincode'],
            ]);

            return $user;
        }

        return User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => null,
            'type' => User::TYPE_USER,
            'password_set' => false,
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'pincode' => $validated['pincode'],
        ]);
    }

    private function createOrderFromCheckout(array $validated, $cartItems): Order
    {
        return DB::transaction(function () use ($validated, $cartItems) {
            $user = $this->resolveCheckoutUser($validated);
            $summary = $this->calculateCartSummary($cartItems);

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'subtotal' => $summary['subtotal'],
                'discount' => $summary['discount'],
                'shipping' => $summary['shipping'],
                'tax' => $summary['tax'],
                'total_amount' => $summary['total'],
                'status' => 'placed',
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'razorpay'
                    ? ($validated['payment_status'] ?? 'authorized')
                    : 'pending',
                'payment_gateway_order_id' => $validated['razorpay_order_id'] ?? null,
                'payment_id' => $validated['razorpay_payment_id'] ?? null,
                'payment_signature' => $validated['razorpay_signature'] ?? null,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'country' => $validated['country'],
                'pincode' => $validated['pincode'],
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'total' => $item->price * $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                ]);

                $item->product->decrement('quantity', $item->quantity);
            }

            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            }

            if (Session::has('cart_session_id')) {
                Cart::where('session_id', Session::get('cart_session_id'))->delete();
            }

            return $order;
        });
    }

    private function fetchRazorpayPaymentStatus(string $paymentId): ?string
    {
        $config = $this->razorpayConfig();

        try {
            $response = Http::withBasicAuth($config['key'], $config['secret'])
                ->acceptJson()
                ->get("https://api.razorpay.com/v1/payments/{$paymentId}");
        } catch (\Throwable $exception) {
            Log::warning('Unable to fetch Razorpay payment status.', [
                'payment_id' => $paymentId,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }

        if (!$response->successful()) {
            Log::warning('Razorpay payment status API returned an error.', [
                'payment_id' => $paymentId,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return null;
        }

        $status = $response->json('status');

        return is_string($status) ? $status : null;
    }

    private function verifyRazorpayPayment(array $validated, $cartItems): string
    {
        if (empty($validated['razorpay_payment_id']) || empty($validated['razorpay_order_id']) || empty($validated['razorpay_signature'])) {
            throw ValidationException::withMessages([
                'payment' => 'Razorpay payment details are missing.',
            ]);
        }

        $config = $this->razorpayConfig();

        if (blank($config['key']) || blank($config['secret'])) {
            throw ValidationException::withMessages([
                'payment' => 'Razorpay is not configured yet.',
            ]);
        }

        $pendingPayment = Session::get('pending_razorpay_checkout');
        $summary = $this->calculateCartSummary($cartItems);

        if (
            empty($pendingPayment['order_id']) ||
            $pendingPayment['order_id'] !== $validated['razorpay_order_id']
        ) {
            throw ValidationException::withMessages([
                'payment' => 'Payment session expired. Please try again.',
            ]);
        }

        if (
            (int) ($pendingPayment['amount'] ?? 0) !== $summary['amount_in_paise'] ||
            ($pendingPayment['cart_signature'] ?? null) !== $this->cartSignature($cartItems)
        ) {
            throw ValidationException::withMessages([
                'payment' => 'Cart details changed before payment verification. Please try again.',
            ]);
        }

        $generatedSignature = hash_hmac(
            'sha256',
            $validated['razorpay_order_id'] . '|' . $validated['razorpay_payment_id'],
            $config['secret']
        );

        if (!hash_equals($generatedSignature, $validated['razorpay_signature'])) {
            throw ValidationException::withMessages([
                'payment' => 'Unable to verify the Razorpay payment signature.',
            ]);
        }

        $paymentStatus = $this->fetchRazorpayPaymentStatus($validated['razorpay_payment_id']);

        if ($paymentStatus !== null && !in_array($paymentStatus, ['authorized', 'captured'], true)) {
            throw ValidationException::withMessages([
                'payment' => 'Razorpay returned an unexpected payment status. Please contact support before retrying.',
            ]);
        }

        return $paymentStatus ?? 'authorized';
    }

    public function createRazorpayOrder(Request $request)
    {
        $validated = $request->validate($this->checkoutRules(false));
        $cartItems = $this->getCartItems();

        try {
            $this->validateCartForCheckout($cartItems);
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->validator->errors()->first(),
            ], 422);
        }

        $config = $this->razorpayConfig();

        if (blank($config['key']) || blank($config['secret'])) {
            return response()->json([
                'success' => false,
                'message' => 'Razorpay credentials are missing. Please update your environment configuration.',
            ], 500);
        }

        $summary = $this->calculateCartSummary($cartItems);
        $receipt = 'rcpt_' . Str::upper(Str::random(12));

        try {
            $response = Http::withBasicAuth($config['key'], $config['secret'])
                ->acceptJson()
                ->post('https://api.razorpay.com/v1/orders', [
                    'amount' => $summary['amount_in_paise'],
                    'currency' => $config['currency'],
                    'receipt' => $receipt,
                    'notes' => [
                        'customer_name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                        'customer_email' => $validated['email'],
                        'customer_phone' => $validated['phone'],
                    ],
                ]);
        } catch (\Throwable $exception) {
            Log::error('Razorpay order creation failed.', [
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to Razorpay right now. Please try again in a moment.',
            ], 500);
        }

        if (!$response->successful()) {
            Log::error('Razorpay order API returned an error.', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to start Razorpay payment. Please check the payment credentials and try again.',
            ], 500);
        }

        $razorpayOrder = $response->json();

        Session::put('pending_razorpay_checkout', [
            'order_id' => $razorpayOrder['id'],
            'amount' => $summary['amount_in_paise'],
            'currency' => $config['currency'],
            'cart_signature' => $this->cartSignature($cartItems),
        ]);

        return response()->json([
            'success' => true,
            'key' => $config['key'],
            'amount' => $razorpayOrder['amount'],
            'currency' => $razorpayOrder['currency'] ?? $config['currency'],
            'order_id' => $razorpayOrder['id'],
            'name' => config('app.name', 'Treza Jewels'),
            'description' => 'Checkout payment',
            'prefill' => [
                'name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
                'email' => $validated['email'],
                'contact' => $validated['phone'],
            ],
            'notes' => [
                'address' => $validated['address'],
            ],
            'theme' => [
                'color' => '#f7a392',
            ],
        ]);
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate($this->checkoutRules());
        $cartItems = $this->getCartItems();

        if ($validated['payment_method'] === 'razorpay') {
            $existingOrder = Order::where('payment_id', $validated['razorpay_payment_id'])->first();

            if ($existingOrder) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order already placed successfully.',
                    'order_id' => $existingOrder->id,
                ]);
            }
        }

        try {
            $this->validateCartForCheckout($cartItems);

            if ($validated['payment_method'] === 'razorpay') {
                $validated['payment_status'] = $this->verifyRazorpayPayment($validated, $cartItems);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->validator->errors()->first(),
                'errors' => $exception->errors(),
            ], 422);
        }

        try {
            $order = $this->createOrderFromCheckout($validated, $cartItems);
            Session::forget('pending_razorpay_checkout');

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully.',
                'order_id' => $order->id,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Order placement failed.', [
                'message' => $exception->getMessage(),
            ]);

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->validator->errors()->first(),
                    'errors' => $exception->errors(),
                ], 422);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function thankYou($order_id)
    {
        $order = Order::with('items.product')->findOrFail($order_id);

        return view('frontend.thank_you', compact('order'));
    }

    public function track($order_number)
    {
        $order = Order::with(['items.product', 'user'])->where('order_number', $order_number)->firstOrFail();

        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('frontend.order.track', compact('order'));
    }
}
