@extends('user.layouts.app')

@push('stylesheet')
    <style>
        .mission li {
            list-style: number;
            list-style-position: inside;
        }
    </style>
@endpush

@section('content')
    <section class="section main-banner" id="top" data-section="section1">
        <div id="bg-video">
            <img
                src="{{ 'https://png.pngtree.com/thumb_back/fh260/background/20230408/pngtree-coffee-beans-leaves-beans-background-image_2177928.jpg' }}" />
        </div>

        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h6>Hello Export Companion</h6>
                            <h2>Welcome to COffes Shop</h2>
                            <p>With our commitment to quality, sustainability and innovation, COffes Shop is
                                poised to become a reliable export partner for international customers seeking access to
                                Indonesia's natural wealth.</p>
                            <div class="main-button-red">
                                <div class="scroll-to-section"><a href="{{ route('product') }}">See Our Product</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-service-item owl-carousel">
                        @foreach ($getService as $item)
                            <div class="item">
                                <div class="icon">
                                    <img src="{{ asset('assets-user/assets/images/service-icon-01.png') }}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>{{ $item->title }}</h4>
                                    <p>{{ Str::limit($item->description, 45, '...') }}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="upcoming-meetings" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Products</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories">
                        <h4>Product Categories</h4>
                        @foreach ($getCategory as $item)
                            <ul>
                                <li>{{ $item->name }}</li>
                            </ul>
                        @endforeach
                        <div class="main-button-red">
                            <a href="{{ route('product') }}">See All Products</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($getProduct->slice(0, 4) as $product)
                            <div class="col-lg-6">
                                <div class="meeting-item">
                                    <div class="thumb" style="height: 200px;">
                                        <div class="price">
                                            <span>{{ $product->category->name }}</span>
                                        </div>
                                        <a href="{{ route('product.detail', $product->slug) }}"
                                            style="width: 100%; height: 100%;">
                                            <img src="{{ asset($product->thumbnail) }}"
                                                style="width: 100%; height: 100%; object-fit: cover;" alt="">
                                        </a>
                                    </div>
                                    <div class="down-content" style="height: 200px;">
                                        <div style="display: block !important;">
                                            <h6>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</h6>
                                        </div>
                                        <a href="{{ route('product.detail', $product->slug) }}" class="mt-2"
                                            style="display: inline-block;">
                                            <h4>{{ $product->name }}</h4>
                                        </a>
                                        <p style="margin-left: 0px;">
                                            {{ Str::limit($product->description, 120, '...') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="apply-now" id="apply">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    @foreach ($getDetailCompany as $item)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="item">
                                    <div class="main-button-red">
                                        <div class="scroll-to-section mb-2" style="color: #ffff"><a>Vision</a></div>
                                    </div>
                                    <p>{{ $item->vision }}</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="item">
                                    <div class="main-button-red">
                                        <div class="scroll-to-section mb-2" style="color: #ffff"><a>Mission</a></div>
                                    </div>
                                    <div class="mission" style="color: white;">
                                        {!! $item->mission !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="accordions is-first-expanded">
                        @foreach ($getDetailCompany as $item)
                            <article class="accordion">
                                <div class="accordion-head">
                                    <span>Description</span>

                                </div>
                                <div class="accordion-body">
                                    <div class="content">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-facts">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>A Few Facts About Our Company</h2>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="count-area-content">
                                        <div class="count-digit">{{ $getProduct->count() }}</div>
                                        <div class="count-title">Total Products</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="count-area-content">
                                        <div class="count-digit">{{ $getCategory->count() }}</div>
                                        <div class="count-title">Total Categories</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="count-area-content new-students">
                                        <div class="count-digit">{{ $getService->count() }}</div>
                                        <div class="count-title">Our Services</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center text-center">
                    <div class="">
                        <a><img class="rounded" src="{{ asset('assets-admin/images/coffe-shop.jpg') }}"
                                style="max-width: 400px" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="contact" action="/email" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>Let's get in touch</h2>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="name" type="text" id="name"
                                                placeholder="YOURNAME...*" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                                placeholder="YOUR EMAIL..." required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input name="subject" type="text" id="subject"
                                                placeholder="SUBJECT...*" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..."
                                                required=""></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">SEND MESSAGE
                                                NOW</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-info">
                        <ul>
                            <li>
                                <h6>Phone Number</h6>
                                @foreach ($phoneNumber as $phone)
                                    <span>{{ $phone->phone_number }}</span>
                                @endforeach
                            </li>
                            @isset($user)
                                <li>
                                    <h6>Email Address</h6>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li>
                                    <h6>Street Address</h6>
                                    <span>{{ $user->address }}</span>
                                </li>
                                <li>
                                    <h6>Website URL</h6>
                                    <span>10122214 - Salsa Ridzkya - IF6</span>
                                </li>
                            </ul>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Copyright © 2024 All Rights Reserved <br>
                <a href="{{ url('/landing-page') }}" title="10122214 - Salsa Ridzkya - IF6">10122214 - Salsa Ridzkya -
                    IF6</a>
            </p>
        </div>
    </section>
@endsection
