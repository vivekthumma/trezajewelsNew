@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-white shadow-sm border-0 rounded-4 overflow-hidden mb-5">
            <div class="card-header bg-white py-4 d-flex align-items-center justify-content-between border-bottom">
                <div>
                    <h5 class="card-title mb-0 fw-bold text-dark">
                        <i class="ri-settings-3-line me-2 text-primary"></i> System Settings
                    </h5>
                    <small class="text-muted">Manage your website's general configuration and information.</small>
                </div>
            </div>
            
            <div class="card-body p-0">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
                    @csrf
                    
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs nav-fill bg-light" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active py-3 fw-bold" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="ri-global-line me-1"></i> General
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 fw-bold" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">
                                <i class="ri-contacts-book-line me-1"></i> Contact Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 fw-bold" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">
                                <i class="ri-share-line me-1"></i> Social Media
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 fw-bold" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab">
                                <i class="ri-information-line me-1"></i> About Us
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 fw-bold" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab">
                                <i class="ri-more-2-line me-1"></i> Other
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4 p-md-5" id="settingsTabContent">
                        
                        <!-- TAB 1: General -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-uppercase">Site Name</label>
                                    <input type="text" name="site_name" class="form-control form-control-lg" value="{{ setting('site_name') }}" placeholder="Enter website name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Site Logo</label>
                                    <div class="image-preview-container border rounded p-3 text-center bg-light mb-2">
                                        <img id="logo-preview" src="{{ setting_asset('site_logo', 'assets/images/no-image.png') }}" class="img-fluid rounded" style="max-height: 100px;">
                                    </div>
                                    <input type="file" name="site_logo" class="form-control" onchange="previewImage(this, 'logo-preview')">
                                    <small class="text-muted">Recommended size: 250x80px (PNG/WebP)</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Favicon Icon</label>
                                    <div class="image-preview-container border rounded p-3 text-center bg-light mb-2">
                                        <img id="favicon-preview" src="{{ setting_asset('favicon', 'assets/images/favicon.png') }}" class="img-fluid rounded" style="max-height: 100px;">
                                    </div>
                                    <input type="file" name="favicon" class="form-control" onchange="previewImage(this, 'favicon-preview')">
                                    <small class="text-muted">Recommended size: 32x32px (ICO/PNG)</small>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: Contact Info -->
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-uppercase text-primary">Office Address</label>
                                    <input type="text" name="address" class="form-control border-primary-subtle" value="{{ setting('address') }}" placeholder="Enter physical address">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-primary">Primary Email</label>
                                    <input type="email" name="email" class="form-control border-primary-subtle" value="{{ setting('email') }}" placeholder="info@trezajewels.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-primary">Secondary Email (Optional)</label>
                                    <input type="email" name="email_secondary" class="form-control border-primary-subtle" value="{{ setting('email_secondary') }}" placeholder="support@trezajewels.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-primary">Primary Phone</label>
                                    <input type="text" name="phone" class="form-control border-primary-subtle" value="{{ setting('phone') }}" placeholder="+91 98765 43210">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-primary">Secondary Phone (Optional)</label>
                                    <input type="text" name="phone_secondary" class="form-control border-primary-subtle" value="{{ setting('phone_secondary') }}" placeholder="+91 99887 65432">
                                </div>
                                <div class="col-12 border-top pt-4 mt-2">
                                    <label class="form-label fw-bold small text-uppercase text-primary"><i class="ri-map-pin-2-line me-1"></i> Google Maps Embed URL</label>
                                    <input type="text" name="google_maps_url" class="form-control border-primary-subtle" value="{{ setting('google_maps_url') }}" placeholder="Paste the src URL from Google Maps embed code">
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: Social Media -->
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase"><i class="ri-instagram-line me-1"></i> Instagram URL</label>
                                    <input type="url" name="instagram" class="form-control" value="{{ setting('instagram') }}" placeholder="https://instagram.com/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase"><i class="ri-facebook-box-line me-1"></i> Facebook URL</label>
                                    <input type="url" name="facebook" class="form-control" value="{{ setting('facebook') }}" placeholder="https://facebook.com/page">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase"><i class="ri-twitter-x-line me-1"></i> Twitter URL</label>
                                    <input type="url" name="twitter" class="form-control" value="{{ setting('twitter') }}" placeholder="https://twitter.com/username">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase"><i class="ri-linkedin-box-line me-1"></i> LinkedIn URL</label>
                                    <input type="url" name="linkedin" class="form-control" value="{{ setting('linkedin') }}" placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: About Us Page -->
                        <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                            
                            <!-- Company Section -->
                            <div class="border rounded p-4 mb-4 bg-light shadow-sm">
                                <h6 class="fw-bold mb-3 jewelry-accent border-bottom pb-2">SECTION 1: Company Info</h6>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small text-uppercase">Company Page Title</label>
                                            <input type="text" name="about_company_title" value="{{ setting('about_company_title') }}" class="form-control" placeholder="Our Company">
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label fw-bold small text-uppercase">Company Description</label>
                                            <textarea name="about_company_description" class="form-control" rows="4">{{ setting('about_company_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small text-uppercase">Company Image</label>
                                        <div class="image-preview-container border rounded p-2 text-center bg-white mb-2">
                                            <img id="about-logo-preview" src="{{ setting_asset('about_company_logo', 'assets/images/other/about-company.png') }}" class="img-fluid rounded shadow-sm" style="max-height: 140px;">
                                        </div>
                                        <input type="file" name="about_company_logo" class="form-control" onchange="previewImage(this, 'about-logo-preview')">
                                    </div>
                                </div>
                            </div>

                            <!-- Vision Section -->
                            <div class="border rounded p-4 mb-4 bg-light shadow-sm">
                                <h6 class="fw-bold mb-3 jewelry-accent border-bottom pb-2">SECTION 2: Our Vision</h6>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small text-uppercase">Vision Title</label>
                                            <input type="text" name="about_vision_title" value="{{ setting('about_vision_title') }}" class="form-control" placeholder="Our Vision">
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label fw-bold small text-uppercase">Vision Description</label>
                                            <textarea name="about_vision_description" class="form-control" rows="4">{{ setting('about_vision_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small text-uppercase">Vision Image</label>
                                        <div class="image-preview-container border rounded p-2 text-center bg-white mb-2">
                                            <img id="about-vision-preview" src="{{ setting_asset('about_vision_image', 'assets/images/no-image.png') }}" class="img-fluid rounded shadow-sm" style="max-height: 140px;">
                                        </div>
                                        <input type="file" name="about_vision_image" class="form-control" onchange="previewImage(this, 'about-vision-preview')">
                                    </div>
                                </div>
                            </div>

                            <!-- Team work Section -->
                            <div class="border rounded p-4 mb-4 bg-light">
                                <h6 class="fw-bold mb-3 jewelry-accent border-bottom pb-2">SECTION 2: Team Work</h6>
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Team Work Title</label>
                                            <input type="text" name="about_team_title" value="{{ setting('about_team_title') }}" class="form-control" placeholder="Team Work">
                                        </div>
                                        <div class="mb-0">
                                            <label class="form-label fw-bold small">Team Work Description</label>
                                            <textarea name="about_team_description" class="form-control" rows="4">{{ setting('about_team_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small">Team work Image</label>
                                        <div class="image-preview-container border rounded p-2 text-center bg-white mb-2">
                                            <img id="about-team-img-preview" src="{{ setting_asset('about_team_image', 'assets/images/other/about-team.png') }}" class="img-fluid rounded" style="max-height: 140px;">
                                        </div>
                                        <input type="file" name="about_team_image" class="form-control" onchange="previewImage(this, 'about-team-img-preview')">
                                    </div>
                                </div>
                            </div>

                            <!-- Achievements & Counters -->
                            <div class="row g-4">
                                <div class="col-md-6 text-center">
                                    <div class="border rounded p-4 h-100 bg-light">
                                        <h6 class="fw-bold mb-3 jewelry-accent border-bottom pb-2">SECTION 3: Achievements</h6>
                                        <div class="row g-3">
                                            <div class="col-4">
                                                <label class="form-label small">Happy Customers</label>
                                                <input type="number" name="about_happy_customers" value="{{ setting('about_happy_customers') }}" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Awards won</label>
                                                <input type="number" name="about_awards" value="{{ setting('about_awards') }}" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label small">Years Exp.</label>
                                                <input type="number" name="about_experience_years" value="{{ setting('about_experience_years') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded p-4 h-100 bg-light">
                                        <h6 class="fw-bold mb-3 jewelry-accent border-bottom pb-2">SECTION 4: Big Counters</h6>
                                        <div class="row g-3">
                                            <div class="col-3">
                                                <label class="form-label small">Years</label>
                                                <input type="number" name="about_years" value="{{ setting('about_years') }}" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label small">Clients</label>
                                                <input type="number" name="about_clients" value="{{ setting('about_clients') }}" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label small">Shops</label>
                                                <input type="number" name="about_shops" value="{{ setting('about_shops') }}" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label small">Sales</label>
                                                <input type="number" name="about_sales" value="{{ setting('about_sales') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Members (Dynamic Repeater) -->
                            <div class="border rounded p-4 mt-4 bg-light">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <h6 class="fw-bold mb-0 jewelry-accent">SECTION 5: Team Members</h6>
                                    <button type="button" class="btn btn-sm btn-success rounded-pill" onclick="addTeamRow()">
                                        <i class="ri-add-line"></i> Add Member
                                    </button>
                                </div>
                                
                                <div id="team-repeater-container">
                                    @php
                                        $teamArr = json_decode(setting('about_team_members', '[]'), true);
                                    @endphp
                                    @forelse($teamArr as $index => $member)
                                    <div class="team-row border rounded bg-white p-3 mb-3 position-relative">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" onclick="removeTeamRow(this)">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="small fw-bold">Name</label>
                                                <input type="text" name="about_team_members[{{ $index }}][name]" value="{{ $member['name'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="small fw-bold">Designation</label>
                                                <input type="text" name="about_team_members[{{ $index }}][designation]" value="{{ $member['designation'] ?? '' }}" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="small fw-bold">Image URL or Static</label>
                                                <input type="text" name="about_team_members[{{ $index }}][image]" value="{{ $member['image'] ?? '' }}" class="form-control" placeholder="assets/images/other/about-team1.jpg">
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-center text-muted no-members py-3">No team members added yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- TAB 5: Other -->
                        <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-uppercase">Footer Copyright Text</label>
                                    <input type="text" name="footer_text" class="form-control" value="{{ setting('footer_text') }}" placeholder="© 2026 Your Company Name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white py-4 border-top">
                        <div class="text-end px-4">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold py-2 shadow-sm">
                                <i class="ri-save-line me-1"></i> Save All Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Preview image on selection
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Team Repeater Logic
    function addTeamRow() {
        var container = $('#team-repeater-container');
        $('.no-members').remove();
        var index = container.find('.team-row').length;
        
        var html = `
        <div class="team-row border rounded bg-white p-3 mb-3 position-relative animate__animated animate__fadeIn">
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" onclick="removeTeamRow(this)">
                <i class="ri-delete-bin-line"></i>
            </button>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="small fw-bold">Name</label>
                    <input type="text" name="about_team_members[${index}][name]" class="form-control" placeholder="John Doe">
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold">Designation</label>
                    <input type="text" name="about_team_members[${index}][designation]" class="form-control" placeholder="Designer">
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold">Image URL or Static</label>
                    <input type="text" name="about_team_members[${index}][image]" class="form-control" placeholder="assets/images/other/about-team1.jpg">
                </div>
            </div>
        </div>`;
        
        container.append(html);
    }

    function removeTeamRow(btn) {
        $(btn).closest('.team-row').remove();
        if($('#team-repeater-container').find('.team-row').length === 0) {
            $('#team-repeater-container').append('<p class="text-center text-muted no-members py-3">No team members added yet.</p>');
        }
    }

    // Handle Success Message with SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            toast: true,
            position: 'top-end'
        });
    @endif

    // Handle Validation Errors
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Wait...',
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#C9A96E'
        });
    @endif
</script>
@endsection

<style>
    .jewelry-accent { color: #C9A96E; }
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease;
    }
    .nav-tabs .nav-link:hover {
        background-color: #f8f9fa;
        color: #C9A96E;
    }
    .nav-tabs .nav-link.active {
        background-color: #fff !important;
        color: #C9A96E !important;
        border-bottom: 3px solid #C9A96E !important;
    }
    .form-label {
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .form-control:focus {
        border-color: #C9A96E;
        box-shadow: 0 0 0 0.25rem rgba(201, 169, 110, 0.25);
    }
</style>
