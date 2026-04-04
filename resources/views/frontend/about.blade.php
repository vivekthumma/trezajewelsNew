@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area py-3 bg-light">
    <div class="container">
        <small>
            <a href="{{ url('/') }}">Home</a> / About us
        </small>
    </div>
</div>

<main>

<!-- ================= ABOUT COMPANY ================= -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-semibold">
            {{ setting('about_company_title', 'Our company') }}
        </h2>

        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="{{ setting('about_company_logo') ? imgPath('uploads/settings/' . setting('about_company_logo')) : asset('assets/images/other/about-company.png') }}"
                     class="img-fluid rounded-4 shadow-sm w-100"
                     style="height:400px; object-fit:cover;">
            </div>

            <div class="col-md-6">
                <h5 class="fw-semibold mb-3">Our company</h5>
                <p class="text-muted">
                    {{ setting('about_company_description') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= VISION ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5 flex-md-row-reverse">
            
            <div class="col-md-6">
                <img src="{{ setting('about_vision_image') ? imgPath('uploads/settings/' . setting('about_vision_image')) : asset('assets/images/other/about-vision.png') }}"
                     class="img-fluid rounded-4 shadow-sm w-100"
                     style="height:400px; object-fit:cover;">
            </div>

            <div class="col-md-6">
                <h5 class="fw-semibold mb-3">Our vision</h5>
                <p class="text-muted">
                    {{ setting('about_vision_description') }}
                </p>
            </div>

        </div>
    </div>
</section>

<!-- ================= TEAM WORK ================= -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <div class="col-md-6">
                <img src="{{ setting('about_team_image') ? imgPath('uploads/settings/' . setting('about_team_image')) : asset('assets/images/other/about-team.png') }}"
                     class="img-fluid rounded-4 shadow-sm w-100"
                     style="height:400px; object-fit:cover;">
            </div>

            <div class="col-md-6">
                <h5 class="fw-semibold mb-3">Team work</h5>
                <p class="text-muted">
                    {{ setting('about_team_description') }}
                </p>
            </div>

        </div>
    </div>
</section>

<!-- about-service start -->
<section class="about-service section-pt text-center">
    <div class="container">
        <div class="row row-mtm justify-content-lg-center">
            <div class="col-12 col-lg-4" data-animate="animate__fadeIn">
                <div class="col-xxl-10 mx-xxl-auto">
                    <h6 class="font-18">{{ setting('about_happy_customers', '5000') }}+ Happy customer</h6>
                    <p class="mst-19">Absolutely delighted with the service! The team was professional and delivered beyond my expectations. Highly recommend!</p>
                </div>
            </div>
            <div class="col-12 col-lg-4" data-animate="animate__fadeIn">
                <div class="col-xxl-10 mx-xxl-auto">
                    <h6 class="font-18">{{ setting('about_awards', '29') }}+ Awards won</h6>
                    <p class="mst-19">Our company has been honored with the Outstanding Achievement Award and Best Industry Leader accolades in recent years.</p>
                </div>
            </div>
            <div class="col-12 col-lg-4" data-animate="animate__fadeIn">
                <div class="col-xxl-10 mx-xxl-auto">
                    <h6 class="font-18">{{ setting('about_experience_years', '40') }}+ years of experiences</h6>
                    <p class="mst-19">With over all years of combined experience in the industry, our team excels in delivering top-notch solutions and services.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-service end -->

<!-- about-feature-counter start -->
<section class="about-feature-counter section-pt">
    <div class="container">
        <div class="row row-mtm30">
            <div class="col-6 col-lg-3 text-center" data-animate="animate__fadeIn">
                <div class="position-relative peb-19">
                    <div class="about-feature-counter-info ptb-10 plr-10 extra-bg box-shadow br-hidden">
                        <div class="d-flex flex-column align-items-center ptb-30 plr-15 plr-sm-30 extra-bg box-shadow border-radius">
                            <h2 class="dominant-color font-32"><span class="count-number" data-count="{{ setting('about_years', 10) }}"></span>+</h2>
                            <div class="secondary-color d-flex align-items-baseline mst-9">Years</div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 z-1">
                        <span class="dominant-color font-20 width-48 height-48 d-inline-flex align-items-center justify-content-center extra-bg box-shadow border-radius"><i class="ri-line-chart-line"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center" data-animate="animate__fadeIn">
                <div class="position-relative peb-19">
                    <div class="about-feature-counter-info ptb-10 plr-10 extra-bg box-shadow br-hidden">
                        <div class="d-flex flex-column align-items-center ptb-30 plr-15 plr-sm-30 extra-bg box-shadow border-radius">
                            <h2 class="dominant-color font-32"><span class="count-number" data-count="{{ setting('about_clients', 100) }}"></span>+</h2>
                            <div class="secondary-color d-flex align-items-baseline mst-9">Clients</div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 z-1">
                        <span class="dominant-color font-20 width-48 height-48 d-inline-flex align-items-center justify-content-center extra-bg box-shadow border-radius"><i class="ri-user-3-line"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center" data-animate="animate__fadeIn">
                <div class="position-relative peb-19">
                    <div class="about-feature-counter-info ptb-10 plr-10 extra-bg box-shadow br-hidden">
                        <div class="d-flex flex-column align-items-center ptb-30 plr-15 plr-sm-30 extra-bg box-shadow border-radius">
                            <h2 class="dominant-color font-32"><span class="count-number" data-count="{{ setting('about_shops', 50) }}"></span>+</h2>
                            <div class="secondary-color d-flex align-items-baseline mst-9">Shops</div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 z-1">
                        <span class="dominant-color font-20 width-48 height-48 d-inline-flex align-items-center justify-content-center extra-bg box-shadow border-radius"><i class="ri-store-2-line"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 text-center" data-animate="animate__fadeIn">
                <div class="position-relative peb-19">
                    <div class="about-feature-counter-info ptb-10 plr-10 extra-bg box-shadow br-hidden">
                        <div class="d-flex flex-column align-items-center ptb-30 plr-15 plr-sm-30 extra-bg box-shadow border-radius">
                            <h2 class="dominant-color font-32"><span class="count-number" data-count="{{ setting('about_sales', 17) }}"></span>+</h2>
                            <div class="secondary-color d-flex align-items-baseline mst-9">Sales</div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 z-1">
                        <span class="dominant-color font-20 width-48 height-48 d-inline-flex align-items-center justify-content-center extra-bg box-shadow border-radius"><i class="ri-shopping-bag-2-line"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-feature-counter end -->

</main>

@endsection