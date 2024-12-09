@extends('user.layouts.app')
@section('content')
    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="meeting-single-item">
                                <div class="thumb"
                                    style="height: 500px; background-color: #e6e5e5; padding: 15px 10px;
                                border-radius: 10px;">
                                    <div class="price" style="height: 100%;">
                                        <span>Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                    <div
                                        style="position: absolute;
                                    background-color: #e6e5e5;
                                    /* width: 80px; */
                                    /* height: 80px; */
                                    text-align: center;
                                    padding: 15px 10px;
                                    border-radius: 10px;
                                    right: 20px;
                                    top: 20px;">
                                        <h6>{{ $product->category->name }}</h6>
                                    </div>
                                    <a href="{{ $product->thumbnail }}" style="height: 100%;"><img
                                            src="{{ asset($product->thumbnail) }}" style="height: 100%; object-fit: cover;"
                                            alt=""></a>
                                </div>
                                <div class="down-content">

                                    <h4>{{ $product->name }}</h4>

                                    <p class="description" style="margin-top: 0;">
                                        {{ $product->description }}
                                    </p>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="hours">
                                                <h5>Hours</h5>
                                                <p>Monday - Friday: 07:00 AM - 13:00 PM<br>Saturday- Sunday: 09:00 AM -
                                                    15:00 PM</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="location">
                                                <h5>Location</h5>
                                                @isset($user)
                                                    <p>{{ $user->address }}
                                                    </p>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="book now">
                                                <h5>Contact Person</h5>
                                                @foreach ($phoneNumber as $phone)
                                                    <p>{{ $phone->phone_number }}
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="main-button-red">
                                <a href="{{ route('product') }}">Back To Product List</a>
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
