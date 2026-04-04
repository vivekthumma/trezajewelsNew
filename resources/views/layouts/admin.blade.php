<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | {{ config('app.name', 'TREZAJEWELS') }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/favicon" href="{{ setting('favicon') ? imgPath('settings/'.setting('favicon')) : asset('assets/images/index2/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- AdminLTE 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    @yield('style')
    <style>
        :root {
            --treza-gold: #C5A028;
            --treza-gold-dark: #B29023;
            --treza-gold-light: #D4AF37;
            --treza-gold-soft: #F9E2AF;
        }

        /* Overwrite AdminLTE Primary */
        .btn-primary, .bg-primary, .accent-primary {
            background-color: var(--treza-gold) !important;
            border-color: var(--treza-gold) !important;
            color: #fff !important;
        }
        
        .btn-primary:hover {
            background-color: var(--treza-gold-dark) !important;
            border-color: var(--treza-gold-dark) !important;
        }

        .text-primary { color: var(--treza-gold) !important; }

        /* Custom Buttons */
        .btn-custom {
            border-radius: 6px;
            font-weight: 500;
            padding: 6px 14px;
            position: relative;
            transition: all 0.2s ease;
        }
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }
        .btn-spinner {
            display: none;
            margin-left: 6px;
        }

        /* Gold Variants */
        .btn-primary-custom { 
            background-color: var(--treza-gold); 
            border-color: var(--treza-gold); 
            color: white; 
        }
        .btn-primary-custom:hover { 
            background-color: var(--treza-gold-dark); 
            border-color: var(--treza-gold-dark); 
            color: white; 
        }
        
        .btn-info-custom { background-color: #0dcaf0; border-color: #0dcaf0; color: #000; }
        .btn-info-custom:hover { background-color: #31d2f2; border-color: #25cff2; color: #000; }
        
        .btn-warning-custom { background-color: #ffc107; border-color: #ffc107; color: #000; }
        .btn-warning-custom:hover { background-color: #ffca2c; border-color: #ffc720; color: #000; }
        
        .btn-danger-custom { background-color: #dc3545; border-color: #dc3545; color: white; }
        .btn-danger-custom:hover { background-color: #bb2d3b; border-color: #b02a37; color: white; }
        
        .btn-success-custom { background-color: #198754; border-color: #198754; color: white; }
        .btn-success-custom:hover { background-color: #157347; border-color: #146c43; color: white; }

        /* Sidebar & Navigation Luxury Accents */
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active,
        .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: var(--treza-gold) !important;
            color: #fff !important;
        }
        
        .app-brand { border-bottom: 1px solid rgba(255,255,255,0.1); }
        .brand-text { color: var(--treza-gold); font-weight: 700; }

        /* Ensure dropdowns aren't cut off in responsive tables */
        .table-responsive {
            overflow: visible !important;
        }
        
        /* Form Focus States Gold */
        .form-control:focus {
            border-color: var(--treza-gold-soft);
            box-shadow: 0 0 0 0.25rem rgba(197, 160, 40, 0.25);
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        
        <!-- Navbar -->
        @include('layouts.partials.nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <main class="app-main">
            <!-- Content Header (Page header) -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('title')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="app-content">
                <div class="container-fluid">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
            <!-- /.content -->
        </main>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
    @yield('script')
    
    <script>
        $(document).ready(function() {
            // Global initialization
            if ($('.select2').length > 0) {
                $('.select2').select2({
                    theme: 'bootstrap-5'
                });
            }
            
            if ($('.datatable').length > 0) {
                $('.datatable').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                });
            }

            // Button loading states
            $(document).on('click', '.btn-with-loader:not([type="submit"])', function () {
                let btn = $(this);
                if (btn.hasClass('btn-loading')) return;
                
                // Only trigger if it's an 'a' tag (link) or a button that isn't a form submitter
                btn.addClass('btn-loading');
                btn.find('.btn-text').hide();
                btn.find('.btn-spinner').show();
            });

            // Form Submit Loading
            $(document).on('submit', 'form', function (e) {
                let form = $(this);
                let btn = form.find('.btn-with-loader[type="submit"]');

                if (btn.length && !btn.hasClass('btn-loading')) {
                    btn.addClass('btn-loading');
                    btn.find('.btn-text').hide();
                    btn.find('.btn-spinner').show();
                }
            });

            // Delete Confirmation
            $(document).on('click', '.delete-btn', function(e) {
                if (!confirm('Are you sure you want to delete this record?')) {
                    e.preventDefault();
                    // If we prevent default, we must stop the spinner if it was already triggered
                    let btn = $(this);
                    btn.removeClass('btn-loading');
                    btn.find('.btn-text').show();
                    btn.find('.btn-spinner').hide();
                    return false;
                }
            });
        });
    </script>
</body>
</html>
