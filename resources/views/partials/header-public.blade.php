<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="https://maps.app.goo.gl/bRiM7xGBLpvTq4TA9" target="_blank"><i class="fa fa-map-marker"></i>Río Cuarto, Córdoba</a></li>
                <li><a href="https://wa.me/5493584022516" target="_blank"><i class="fa fa-phone"></i>+54 9 3584 02-2516</a></li>
                <li><a href="mailto:info@onrails.com.ar" target="_blank"><i class="fa fa-envelope-o"></i>info@onrails.com.ar</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-dollar"></i> ARS</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    {{-- Tune vertical size via --header-banner-height in style.css --}}
    <div id="header">
        <svg class="header-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160" preserveAspectRatio="none" aria-hidden="true" focusable="false">
            <rect width="1440" height="160" fill="#D10024"/>
            {{-- Split Y matches logo red-bar top: 1700/3200 of viewBox (= 85/160) --}}
            <path fill="#4A5C78" d="M0 0h1440v85H0z"/>
            <path fill="none" stroke="#F0C43A" stroke-width="1.25" vector-effect="non-scaling-stroke" d="M0 85H1440"/>
        </svg>

        <a href="{{ route('home') }}" class="header-logo-link">
            <img src="{{ asset('img/logo-onrails.svg') }}?v=5" alt="On Rails">
        </a>

        <div class="container header-banner-content">
            <div class="header-search">
                <form>
                    <select class="input-select" id="header-category-select" name="category">
                        <option value="">Categorías</option>
                        @foreach(($publicCategoryOptions ?? []) as $id => $label)
                            <option value="{{ $id }}" {{ request('category') == $id ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input class="input" name="search" placeholder="Buscar" value="{{ request('search') }}">
                    <button class="search-btn" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                @forelse($menus ?? [] as $menu)
                    <li>
                        @if($menu->isExternal())
                            <a href="{{ $menu->link }}" target="_blank" rel="noopener noreferrer">{{ $menu->title }}</a>
                        @else
                            <a href="{{ $menu->link }}">{{ $menu->title }}</a>
                        @endif
                    </li>
                @empty
                    <!-- Fallback to default menu items -->
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('store') }}">Tienda</a></li>
                @endforelse
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
