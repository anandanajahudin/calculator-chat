@extends('layouts.front')

@section('title', 'Index')

@section('content')

    @include('layouts.components.front.navbar')
    @include('layouts.components.front.hero')
    @include('layouts.components.front.client')

    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-lg-0 mb-4">
                    <div class="box-with-humber bg-white p-5">
                        <span class="icon icon-format_paint mr-2 text-primary h3 mb-3 d-block"></span>
                        <h2 class="text-primary">Brand Strategy</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium
                            eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Customer Experience</li>
                            <li>Product Management</li>
                            <li>Proof of Concept</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-lg-0 mb-4" data-jarallax-element="-50">
                    <div class="box-with-humber bg-white p-5">
                        <span class="icon icon-palette mr-2 text-primary h3 mb-3 d-block"></span>

                        <h2 class="text-primary">Visual Identity</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium
                            eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Web Design</li>
                            <li>Branding</li>
                            <li>Web &amp; App Development</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-lg-0 mb-4" data-jarallax-element="20">
                    <div class="box-with-humber bg-white p-5">
                        <span class="icon icon-laptop2 mr-2 text-primary h3 mb-3 d-block"></span>

                        <h2 class="text-primary">Web Design</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium
                            eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Social Media</li>
                            <li>Paid Campaigns</li>
                            <li>Marketing &amp; SEO</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="site-section">
        <div class="container">
            <div class="row align-items-center justify-content-around">
                <div class="col-lg-5" data-jarallax-element="-50">
                    <h2 class="text-primary">Web Design</h2>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium eos
                        nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                    <ul class="list-unstyled ul-check primary">
                        <li>Social Media</li>
                        <li>Paid Campaigns</li>
                        <li>Marketing &amp; SEO</li>
                    </ul>
                </div>

                <div class="col-lg-6" data-jarallax-element="50">
                    <img src="{{ asset('front/images/img_2.jpg') }}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section> --}}

    <section class="site-section" id="work-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="site-section-heading text-center">Our Works</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, itaque
                        neque, delectus odio iure explicabo.</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_1.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_1.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Laptop on the Table</h2>
                            <span class="category">Web Application</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_2.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_2.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Wrist Watches</h2>
                            <span class="category">Branding</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_3.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_3.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Nike Shoe</h2>
                            <span class="category">Website</span>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_4.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_4.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Tall Chair</h2>
                            <span class="category">Web Application</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_5.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_5.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Drone</h2>
                            <span class="category">Branding</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_6.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_6.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Architect</h2>
                            <span class="category">Website</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_7.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_7.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Flower</h2>
                            <span class="category">Web Application</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_8.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_8.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Headset</h2>
                            <span class="category">Branding</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_9.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_9.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Amazon Speaker</h2>
                            <span class="category">Website</span>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_10.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_10.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Battle Creek</h2>
                            <span class="category">Web Application</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_11.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_11.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Nouri</h2>
                            <span class="category">Branding</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="{{ asset('front/images/img_12.jpg') }}" class="media-1" data-fancybox="gallery">
                        <img src="{{ asset('front/images/img_12.jpg') }}" alt="Image" class="img-fluid">
                        <div class="media-1-content">
                            <h2>Fiber Cloth</h2>
                            <span class="category">Website</span>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </section>

    <section class="section ft-feature-1">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-12 w-100 ft-feature-1-content">
                    <div class="row align-items-center">
                        <div class="col-lg-5" data-jarallax-element="50">

                            <img src="{{ asset('front/images/img_13.jpg') }}" alt="Image"
                                class="img-fluid mb-4 mb-lg-0">

                        </div>
                        <div class="col-lg-3 ml-auto" data-jarallax-element="-50">
                            <div class="mb-5">
                                <h3 class="d-flex align-items-center"><span
                                        class="icon icon-beach_access mr-2"></span><span>Strategy</span></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ab nihil quam
                                    nesciunt.</p>
                                <p><a href="#">Read More</a></p>
                            </div>

                            <div>
                                <h3 class="d-flex align-items-center"><span class="icon icon-build mr-2"></span><span>Web
                                        Development</span></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ab nihil quam
                                    nesciunt.</p>
                                <p><a href="#">Read More</a></p>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <div class="mb-5">
                                <h3 class="d-flex align-items-center"><span
                                        class="icon icon-format_paint mr-2"></span><span>Art Direction</span></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ab nihil quam
                                    nesciunt.</p>
                                <p><a href="#">Read More</a></p>
                            </div>

                            <div>
                                <h3 class="d-flex align-items-center"><span
                                        class="icon icon-question_answer mr-2"></span><span>Copywriting</span></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque ab nihil quam
                                    nesciunt.</p>
                                <p><a href="#">Read More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('pages.front.testimoni')
    @include('pages.front.service')
    @include('pages.front.about')
    @include('pages.front.team')
    @include('pages.front.blog')
    @include('pages.front.contact')

@endsection
