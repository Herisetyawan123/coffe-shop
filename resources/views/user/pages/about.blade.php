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
    <section class="heading-page-about header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6>About Us</h6>
                    <h2>10122214 - Salsa Ridzkya - IF6</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="meeting-single-item">
                                <div class="thumb">
                                    <div class="price">
                                        <span style="background-color: #a12c2f;color:#ffff">Jember, East Java</span>
                                    </div>
                                    <div class="date">
                                        <h6>Est. <span>2024</span></h6>
                                    </div>
                                    {{-- <img src="{{asset('assets-user/assets/images/about.jpg')}}"  alt=""> --}}
                                </div>
                                <div class="down-content" style="border-radius:20px">
                                    <div class="text-center">
                                        <h2 class="fw-bold">10122214 - Salsa Ridzkya - IF6</h2>
                                        <p class="mb-3 text-center">Export supplier for specialty materials from Indonesia
                                        </p>
                                        <div class="text-center">
                                            <img src="{{ asset('assets-admin/images/coffe-shop.jpg') }}"
                                                style="max-width: 200px" class="rounded" alt="">
                                        </div>
                                    </div>
                                    @foreach ($getCompanyDetail as $item)
                                        <p class="description text-center">
                                            {{ $item->description }}
                                        </p>
                                        <div class="row mb-5">
                                            <div class="">
                                                <div class="hours">
                                                    <h5>Our Vision</h5>
                                                    <p>
                                                        {{ $item->vision }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <div class="hours">
                                                    <h5>Our Mission</h5>
                                                    <div class="mission">
                                                        {!! $item->mission !!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="main-button-red">
                                <a href="{{ url('/') }}">Back To Home</a>
                            </div>
                        </div>
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
