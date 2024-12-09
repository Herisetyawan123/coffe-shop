@extends('user.layouts.app')
@section('content')
    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="meeting-single-item">
                                <div class="down-content text-center" style="border-radius: 20px">
                                    <h4 style="">Contact Us</h4>
                                    @isset($user)
                                        <p style="margin-top: -16px">{{ $user->address }}</p>
                                    @endisset
                                    <div class="maps col-12 my-5" style="overflow: hidden;">
                                        <iframe style="border-radius: 20px;overflow: hidden;"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d638.0314077706216!2d113.69486955710582!3d-8.191547068818448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6969900b74a23%3A0x863ddcf3127c7d60!2sJl.%20Teuku%20Umar%2C%20Kabupaten%20Jember%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1715411568843!5m2!1sid!2sid"
                                            width="1000" height="450" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <div class="row">
                                        @isset($user)
                                            <div class="col-lg-4">
                                                <div class="hours">
                                                    <h5>Phone Number</h5>
                                                    @foreach ($phoneNumber as $phone)
                                                        <p>{{ $phone->phone_number }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="location">
                                                    <h5>Email</h5>
                                                    <p>{{ $user->email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="book now">
                                                    <h5>Open</h5>
                                                    <p>Monday - Saturday</p>
                                                </div>
                                            </div>
                                        @endisset
                                        <div class="col-lg-12">
                                            <div class="share">
                                                <h5>Coffee shop</h5>
                                            </div>
                                        </div>
                                    </div>
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
