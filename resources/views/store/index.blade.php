@extends('components.layouts.public')

@section('title', 'Tienda - Productos')

@section('content')
{{--
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @if(request('category'))
                        @php
                            $selectedCategory = $categories->flatten()->where('id', request('category'))->first();
                        @endphp
                        @if($selectedCategory)
                            <li class="active">{{ $selectedCategory->name }}</li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
--}}

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categorías</h3>
                    <div class="checkbox-filter">
                        @foreach($categories as $category)
                            <!-- Parent category - display only, not selectable -->
                            <div class="input-checkbox" style="opacity: 0.6;">
                                <input type="checkbox" id="category-{{ $category->id }}"
                                       value="{{ $category->id }}" disabled
                                       style="pointer-events: none;">
                                <label for="category-{{ $category->id }}" style="cursor: default;">
                                    <span></span>
                                    <strong>{{ $category->name }}</strong>
                                    <small>({{ $category->activeProducts()->count() }})</small>
                                </label>
                            </div>

                            @foreach($category->children as $child)
                                <div class="input-checkbox" style="margin-left: 20px;">
                                    <input type="checkbox" id="category-{{ $child->id }}"
                                           value="{{ $child->id }}"
                                           {{ request('category') == $child->id ? 'checked' : '' }}>
                                    <label for="category-{{ $child->id }}">
                                        <span></span>
                                        {{ $child->name }}
                                        <small>({{ $child->activeProducts()->count() }})</small>
                                    </label>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <!-- /aside Widget -->

{{--
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Precio</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <div class="input-number price-min">
                            <input id="price-min" type="number" name="min_price"
                                   value="{{ request('min_price') }}" placeholder="Min">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input id="price-max" type="number" name="max_price"
                                   value="{{ request('max_price') }}" placeholder="Max">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->
--}}
            </div>
            <!-- /ASIDE -->

            <!-- STORE -->
            <div id="store" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Ordenar por:
                            <select class="input-select" id="sort-select" name="sort">
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Precio</option>
                            </select>
                        </label>

                        <label>
                            Orden:
                            <select class="input-select" id="order-select" name="order">
                                <option value="asc" {{ request('order', 'asc') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                <option value="desc" {{ request('order', 'asc') == 'desc' ? 'selected' : '' }}>Descendente</option>
                            </select>
                        </label>

                        <label>
                            Mostrar:
                            <select class="input-select" id="per-page-select" name="per_page">
                                <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>
                                <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
                                <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48</option>
                            </select>
                        </label>
                    </div>
                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div class="row">
                    @forelse($products as $product)
                        <!-- product -->
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img product-img-store">
                                    <a href="{{ route('store.product', $product) }}">
                                    @if($product->getFirstMediaUrl('products', 'small'))
                                        <img src="{{ $product->getFirstMediaUrl('products', 'small') }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('img/placeholder.png') }}" alt="{{ $product->name }}">
                                    @endif
                                    </a>

                                    @if($product->featured)
                                        <div class="product-label">
                                            <span class="new">Novedad!</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <p class="product-category">
                                        @foreach($product->categories as $category)
                                            {{ $category->name }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </p>
                                    <h3 class="product-name"><a href="{{ route('store.product', $product) }}">{{ $product->name }}</a></h3>
                                    @if ($product->price)
                                        <h4 class="product-price">${{ number_format($product->price, 2) }}</h4>
                                    @else
                                        <h4 class="product-price">Consultar</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /product -->

                        @if($loop->iteration % 3 == 0)
                            <div class="clearfix visible-lg visible-md"></div>
                        @endif
                        @if($loop->iteration % 2 == 0)
                            <div class="clearfix visible-sm visible-xs"></div>
                        @endif
                    @empty
                        <div class="col-md-12">
                            <div class="text-center">
                                <h3>No se ha encontrado productos con estas características.</h3>
                                <p>Intente modificar el criterio de búsqueda, o comience visualizando todas las categorías.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- /store products -->

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Filter Form -->
<form id="filter-form" method="GET" action="{{ route('home') }}">
    <input type="hidden" name="category" id="selected-category" value="{{ request('category') }}">
    <input type="hidden" name="min_price" id="min-price" value="{{ request('min_price') }}">
    <input type="hidden" name="max_price" id="max-price" value="{{ request('max_price') }}">
    <input type="hidden" name="sort" id="selected-sort" value="{{ request('sort', 'name') }}">
    <input type="hidden" name="order" id="selected-order" value="{{ request('order', 'asc') }}">
    <input type="hidden" name="per_page" id="selected-per-page" value="{{ request('per_page', 12) }}">
</form>

@push('scripts')
<script>
// Wait for the page to fully load
window.addEventListener('load', function() {
    console.log('Page loaded, initializing store filters...');

    // Initialize ordering dropdowns
    initializeOrderingDropdowns();

    // Initialize category filters
    initializeCategoryFilters();

    // Initialize price filters (if they exist)
    initializePriceFilters();
});

function initializeOrderingDropdowns() {
    console.log('Initializing ordering dropdowns...');

    // Sort dropdown
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        console.log('Sort select found:', sortSelect);
        sortSelect.addEventListener('change', function() {
            console.log('Sort changed to:', this.value);
            updateHiddenField('selected-sort', this.value);
            showLoadingState();
            submitFilterForm();
        });
    } else {
        console.error('Sort select not found');
    }

    // Order direction dropdown
    const orderSelect = document.getElementById('order-select');
    if (orderSelect) {
        console.log('Order select found:', orderSelect);
        orderSelect.addEventListener('change', function() {
            console.log('Order changed to:', this.value);
            updateHiddenField('selected-order', this.value);
            showLoadingState();
            submitFilterForm();
        });
    } else {
        console.error('Order select not found');
    }

    // Per page dropdown
    const perPageSelect = document.getElementById('per-page-select');
    if (perPageSelect) {
        console.log('Per page select found:', perPageSelect);
        perPageSelect.addEventListener('change', function() {
            console.log('Per page changed to:', this.value);
            updateHiddenField('selected-per-page', this.value);
            showLoadingState();
            submitFilterForm();
        });
    } else {
        console.error('Per page select not found');
    }
}

function initializeCategoryFilters() {
    const categoryCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Uncheck other categories
                categoryCheckboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
                updateHiddenField('selected-category', this.value);
            } else {
                updateHiddenField('selected-category', '');
            }
            submitFilterForm();
        });
    });
}

function initializePriceFilters() {
    const minPrice = document.getElementById('price-min');
    const maxPrice = document.getElementById('price-max');

    if (minPrice) {
        minPrice.addEventListener('change', function() {
            updateHiddenField('min-price', this.value);
            submitFilterForm();
        });
    }

    if (maxPrice) {
        maxPrice.addEventListener('change', function() {
            updateHiddenField('max-price', this.value);
            submitFilterForm();
        });
    }
}

function updateHiddenField(fieldId, value) {
    const hiddenField = document.getElementById(fieldId);
    if (hiddenField) {
        hiddenField.value = value;
        console.log('Updated', fieldId, 'to:', value);
    } else {
        console.error('Hidden field not found:', fieldId);
    }
}

function showLoadingState() {
    const storeContainer = document.getElementById('store');
    if (storeContainer) {
        storeContainer.style.opacity = '0.6';
        storeContainer.style.pointerEvents = 'none';
    }
}

function submitFilterForm() {
    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
        console.log('Submitting filter form...');
        filterForm.submit();
    } else {
        console.error('Filter form not found!');
    }
}

// Fallback: also try to initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM ready, checking if elements exist...');

    // If elements are already available, initialize immediately
    if (document.getElementById('sort-select') &&
        document.getElementById('order-select') &&
        document.getElementById('per-page-select')) {
        console.log('Elements found on DOM ready, initializing...');
        initializeOrderingDropdowns();
        initializeCategoryFilters();
        initializePriceFilters();
    }
});
</script>
@endpush
@endsection
