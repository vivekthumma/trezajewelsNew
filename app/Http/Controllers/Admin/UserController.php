<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        // Only show registered customers (non-admins) in the customers list
        $users = User::where('type', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified customer.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
