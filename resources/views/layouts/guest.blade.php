<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Log In') | {{ config('app.name', 'TREZAJEWELS') }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/favicon" href="{{ setting_asset('favicon', 'assets/images/index2/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- AdminLTE 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    
    <style>
        .login-page {
            background-color: #f4f6f9;
        }
    </style>
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo mb-4">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex flex-column align-items-center">
                <img src="{{ setting_asset('site_logo', 'assets/images/index2/logo.png') }}" alt="Logo" class="img-fluid mb-2" style="max-height: 80px;">
                <div class="text-dark"><b>TREZA</b>JEWELS</div>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary shadow">
            <div class="card-body login-card-body">
                @yield('content')
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
