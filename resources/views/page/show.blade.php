@extends('components.layouts.public')

@section('title', $page->title)

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- page content -->
                <div class="col-md-12">
                    <div class="page-content">
                        <h1 class="page-title">{{ $page->title }}</h1>
                        
                        <div class="page-body">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
                <!-- /page content -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection

@push('styles')
<style>
    .page-content {
        padding: 40px 0;
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
        color: #333;
        text-align: center;
    }
    
    .page-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #666;
    }
    
    .page-body h1,
    .page-body h2,
    .page-body h3,
    .page-body h4,
    .page-body h5,
    .page-body h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #333;
    }
    
    .page-body h1 { font-size: 2rem; }
    .page-body h2 { font-size: 1.75rem; }
    .page-body h3 { font-size: 1.5rem; }
    .page-body h4 { font-size: 1.25rem; }
    .page-body h5 { font-size: 1.1rem; }
    .page-body h6 { font-size: 1rem; }
    
    .page-body p {
        margin-bottom: 1.5rem;
    }
    
    .page-body ul,
    .page-body ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    
    .page-body li {
        margin-bottom: 0.5rem;
    }
    
    .page-body blockquote {
        border-left: 4px solid #e74c3c;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #666;
    }
    
    .page-body img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 8px;
    }
    
    .page-body a {
        color: #e74c3c;
        text-decoration: none;
    }
    
    .page-body a:hover {
        text-decoration: underline;
    }
</style>
@endpush
