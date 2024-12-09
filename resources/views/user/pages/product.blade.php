@extends('user.layouts.app')
@section('content')
    <section class="heading-page header-text" id="top"
        style="background-image: url({{ asset('https://png.pngtree.com/thumb_back/fh260/background/20230411/pngtree-coffee-beans-coffee-plant-background-vintage-poster-image_2267692.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 style="color: #1f262c; text-shadow: 1px 1px white;">HERE ARE OUR PRODUCTS</h6>
                    <h2 style="color: #1f262c; text-shadow: 1px 1px white;">Our Product</h2>
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
                            <div class="filters">
                                <ul>
                                    <li data-filter="*" class="active mt-1" style="min-width: 200px;">All Product</li>
                                    @foreach ($categories as $category)
                                        <li data-filter=".cat-{{ $category->id }}" class="mt-1" style="min-width: 200px;">
                                            {{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row grid">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 templatemo-item-col all cat-{{ $product->category->id }}">
                                        <div class="meeting-item">
                                            <div class="thumb" style="height: 200px;">
                                                <div class="price">
                                                    <span>{{ $product->category->name }}</span>
                                                </div>
                                                <a href="{{ route('product.detail', $product->slug) }}"
                                                    style="width: 100%; height: 100%;">
                                                    <img src="{{ asset($product->thumbnail) }}"
                                                        style="width: 100%; height: 100%; object-fit: cover;"
                                                        alt="">
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
