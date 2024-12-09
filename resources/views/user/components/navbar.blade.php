<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets-admin/images/coffe-shop.jpg') }}" class="rounded" width="100"
                            height="70" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('home') }}"
                                class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('about') }}"
                                class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                        <li><a href="{{ route('product') }}"
                                class="{{ request()->routeIs('product') ? 'active' : '' }}">Product</a></li>
                        <li><a href="{{ route('contact-us') }}"
                                class="{{ request()->routeIs('contact-us') ? 'active' : '' }}">Contact Us</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
