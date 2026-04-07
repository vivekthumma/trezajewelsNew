@extends('layouts.app')

@section('title', 'Contact Us - Treza Jewels')

@section('content')

<!-- Breadcrumb -->
<div class="py-3 bg-light border-bottom">
    <div class="container">
        <small>
            <a href="{{ url('/') }}">Home</a> / Contact us
        </small>
    </div>
</div>

<main>

<!-- ================= TITLE ================= -->
<section class="py-5 text-center">
    <div class="container">
        <h2 class="fw-semibold">Get in touch</h2>
        <p class="text-muted">We’d love to hear from you</p>
    </div>
</section>

<!-- ================= MAP ================= -->
<section class="container mb-5">
    <div style="width:100%; height:400px; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">
    
        <iframe 
            src="{{ setting('google_maps_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.8100557993057!2d70.77390258617667!3d22.247284492551717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959caf0e744d3b3%3A0xeb25a891e4e0d366!2sJK%20Sagar%20Vatika!5e0!3m2!1sen!2sin!4v1775213458742!5m2!1sen!2sin') }}"
            width="100%" 
            height="100%" 
            style="border:0;"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Location">
        </iframe>
    
    </div>
</section>

<!-- ================= CONTACT SECTION ================= -->
<section class="pb-5">
    <div class="container">
        <div class="row g-5">

            <!-- LEFT FORM -->
            <div class="col-md-6">
                <div class="p-4 p-md-5 bg-white shadow-sm rounded-4 h-100">

                    <h5 class="fw-semibold mb-4">Send Message</h5>

                    <form id="contact-form" method="post">
                        @csrf

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control rounded-3"
                                placeholder="Full Name" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control rounded-3"
                                placeholder="Email Address" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control rounded-3"
                                placeholder="Phone Number">
                        </div>

                        <div class="mb-3">
                            <textarea name="message" rows="4"
                                class="form-control rounded-3"
                                placeholder="Your Message" required></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="policy-agree">
                            <label class="form-check-label small">
                                I agree to terms & privacy policy
                            </label>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="btn btn-dark w-100 rounded-3 opacity-50 disabled">
                            Send Message
                        </button>

                    </form>

                    <div id="form-response" class="mt-3"></div>
                </div>
            </div>

            <!-- RIGHT CONTACT INFO -->
            <div class="col-md-6">
                <div class="p-4 p-md-5 bg-light rounded-4 h-100">

                    <h5 class="fw-semibold mb-4">Contact Info</h5>

                    <!-- Address -->
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                style="width:50px;height:50px;">
                                📍
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Address</h6>
                            <small class="text-muted lh-base">
                                {{ setting('address', '1234 MG Road, Bengaluru, Karnataka 560001, India') }}
                            </small>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                style="width:50px;height:50px;">
                                📞
                            </div>
                        </div>
                        <div>
                            @php
                                $formatPhone = function($phone) {
                                    $number = preg_replace('/[^0-9]/', '', $phone);
                                    if (strlen($number) == 10) {
                                        return '+91 ' . substr($number, 0, 5) . ' ' . substr($number, 5);
                                    } elseif (strlen($number) == 12 && str_starts_with($number, '91')) {
                                        return '+91 ' . substr($number, 2, 5) . ' ' . substr($number, 7);
                                    }
                                    return $phone;
                                };
                            @endphp
                            <h6 class="mb-1">Phone</h6>
                            <small class="text-muted d-block font-20">
                                <a href="tel:{{ setting('phone') }}" class="text-muted text-decoration-none">{{ $formatPhone(setting('phone', '+91 98765 43210')) }}</a>
                            </small>
                            @if(setting('phone_secondary'))
                            <small class="text-muted d-block mt-1 font-20">
                                <a href="tel:{{ setting('phone_secondary') }}" class="text-muted text-decoration-none">{{ $formatPhone(setting('phone_secondary')) }}</a>
                            </small>
                            @endif
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                style="width:50px;height:50px;">
                                ✉️
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Email</h6>
                            <small class="text-muted d-block">
                                {{ setting('email', 'info@trezajewels.com') }}
                            </small>
                            @if(setting('email_secondary'))
                            <small class="text-muted d-block mt-1">
                                {{ setting('email_secondary') }}
                            </small>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

</main>

@endsection


@push('js')
<script>
$(document).ready(function () {

    // checkbox enable button
    $('#policy-agree').on('change', function () {
        if ($(this).is(':checked')) {
            $('#submit-btn').removeClass('opacity-50 disabled');
        } else {
            $('#submit-btn').addClass('opacity-50 disabled');
        }
    });

    // ajax submit
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();

        let btn = $('#submit-btn');
        let responseDiv = $('#form-response');

        btn.text('Sending...').prop('disabled', true);
        responseDiv.html('');

        $.ajax({
            url: "{{ route('contact.store') }}",
            type: "POST",
            data: $(this).serialize(),

            success: function (res) {
                responseDiv.html('<div class="alert alert-success">' + res.message + '</div>');
                $('#contact-form')[0].reset();
                btn.text('Send Message').prop('disabled', false).addClass('opacity-50 disabled');
            },

            error: function () {
                responseDiv.html('<div class="alert alert-danger">Something went wrong!</div>');
                btn.text('Send Message').prop('disabled', false);
            }
        });
    });

});
</script>
@endpush