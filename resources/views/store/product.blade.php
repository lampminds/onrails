@extends('components.layouts.public')

@section('title', $product->name . ' - Product Details')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('store') }}">Tienda</a></li>
                    @foreach($product->categories as $category)
                        <li><a href="{{ route('store', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    @if($product->getMedia('products')->count() > 0)
                        @foreach($product->getMedia('products') as $media)
                            <div class="product-preview">
                                <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @else
                        <div class="product-preview">
                            <img src="{{ asset('img/placeholder.png') }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    @if($product->getMedia('products')->count() > 0)
                        @foreach($product->getMedia('products') as $media)
                            <div class="product-preview">
                                <img src="{{ $media->getUrl() }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @else
                        <div class="product-preview">
                            <img src="{{ asset('img/placeholder.png') }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#tab3">10 comentario(s) | Agregá el tuyo</a>
                    </div>
                    @if ($product->price)
                    <div>
                        <h3 class="product-price">{{ formatNumber($product->price, true) }}</h3>
                        <span class="product-available">En Stock</span>
                    </div>
                    @else
                        <div>
                            <h3 class="product-price">Consultar precio</h3>
                            <span class="product-available">Consulte disponibilidad</span>
                        </div>
                    @endif

{{--
                    <div class="product-options">
                        <label>
                            Size
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div>

                    <div class="add-to-cart">
                        <div class="qty-label">
                            Qty
                            <div class="input-number">
                                <input type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul>
--}}

                    <ul class="product-links">
                        <li>Categoría:</li>
                        @foreach($product->categories as $category)
                            <li><a href="{{ route('store', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="product-links">
                        <li>Compartir:</li>
                        <li><a href="{{ social_link_facebook(route('store.product', $product->slug)) }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ social_link_whatsapp(route('store.product', $product->slug)) }}"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="{{ social_link_twitter(route('store.product', $product->slug), 'Mirá qué interesante lo que encontré!') }}"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{ social_link_email(route('store.product', $product->slug), 'Mirá qué interesante lo que encontré en OnRails.com.ar!') }}"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Descripción</a></li>
                        <li><a data-toggle="tab" href="#tab2">Historia</a></li>
                        <li><a data-toggle="tab" href="#tab3">Comentarios (3)</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $product->history !!}
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>4.5</span>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form class="review-form">
                                            <input class="input" type="text" placeholder="Your Name">
                                            <input class="input" type="email" placeholder="Your Email">
                                            <textarea class="input" placeholder="Your Review"></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            @foreach($relatedProducts as $relatedProduct)
                <!-- product -->
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            @if($relatedProduct->getFirstMediaUrl('products'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('products') }}" alt="{{ $relatedProduct->name }}">
                            @else
                                <img src="{{ asset('img/placeholder.png') }}" alt="{{ $relatedProduct->name }}">
                            @endif
                            @if($relatedProduct->featured)
                                <div class="product-label">
                                    <span class="new">Novedad!</span>
                                </div>
                            @endif
                        </div>
                        <div class="product-body">
                            <p class="product-category">
                                @foreach($relatedProduct->categories as $category)
                                    {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </p>
                            <h3 class="product-name"><a href="{{ route('store.product', $relatedProduct) }}">{{ $relatedProduct->name }}</a></h3>
                            <h4 class="product-price">${{ number_format($relatedProduct->price, 2) }}</h4>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                            </div>
                        </div>
{{--
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
--}}
                    </div>
                </div>
                <!-- /product -->
            @endforeach

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
@push('scripts')
<script>
// Fix for Bootstrap tabs not showing first tab content on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Product page loaded, fixing tab initialization...');
    
    // Ensure the first tab is properly activated
    const firstTab = document.querySelector('#product-tab .tab-nav li:first-child a');
    const firstTabContent = document.querySelector('#tab1');
    
    if (firstTab && firstTabContent) {
        console.log('First tab found, ensuring it\'s active...');
        
        // Remove active class from all tabs and content
        document.querySelectorAll('#product-tab .tab-nav li').forEach(li => {
            li.classList.remove('active');
        });
        document.querySelectorAll('#product-tab .tab-content .tab-pane').forEach(pane => {
            pane.classList.remove('active', 'in');
        });
        
        // Add active class to first tab and show its content
        firstTab.parentElement.classList.add('active');
        firstTabContent.classList.add('active', 'in');
        
        console.log('First tab activated successfully');
    } else {
        console.error('First tab elements not found');
    }
});

// Alternative approach: Use Bootstrap's tab method if available
window.addEventListener('load', function() {
    if (typeof $ !== 'undefined' && $.fn.tab) {
        console.log('jQuery and Bootstrap tabs available, initializing...');
        
        // Initialize Bootstrap tabs
        $('#product-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            console.log('Tab shown:', e.target.getAttribute('href'));
        });
        
        // Ensure first tab is shown
        $('#product-tab .tab-nav li:first-child a').tab('show');
    } else {
        console.log('jQuery or Bootstrap tabs not available, using vanilla JS approach');
    }
});
</script>
@endpush
@endsection
