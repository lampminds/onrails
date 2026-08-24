@extends('components.layouts.public')

@section('title', 'Home')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Nuestros Productos</h3>
{{--
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                            </ul>
                        </div>
--}}
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @forelse($sliders as $slider)
                                        <!-- slider item -->
                                        <div class="product">
                                            <div class="product-img">
                                                @if($slider->getFirstMediaUrl('slider_images'))
                                                    <img src="{{ $slider->getFirstMediaUrl('slider_images') }}" alt="{{ $slider->title }}">
                                                @else
                                                    <img src="{{ asset('img/placeholder.png') }}" alt="{{ $slider->title }}">
                                                @endif
                                                
                                                @if($slider->title || $slider->description)
                                                    <div class="product-label">
                                                        @if($slider->title)
                                                            <span class="new">{{ $slider->title }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            @if($slider->description)
                                                <div class="product-body">
                                                    <h3 class="product-name">
                                                        @if($slider->link)
                                                            @if(str_starts_with($slider->link, 'http'))
                                                                <a href="{{ $slider->link }}" target="_blank" rel="noopener noreferrer">{{ $slider->description }}</a>
                                                            @else
                                                                <a href="{{ $slider->link }}">{{ $slider->description }}</a>
                                                            @endif
                                                        @else
                                                            {{ $slider->description }}
                                                        @endif
                                                    </h3>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /slider item -->
                                    @empty
                                        <!-- fallback to original static images if no sliders exist -->
                                        @for ($i = 1; $i <= 9; $i++)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="./img/product0{{ $i }}.jpg" alt="">
                                                </div>
                                            </div>
                                            <!-- /product -->
                                        @endfor
                                    @endforelse
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
