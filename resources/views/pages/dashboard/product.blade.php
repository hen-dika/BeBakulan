@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Products</h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('dashboard-product-create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add New Product
                    </a>
                </div>
            </div>
            <div class="row mt-4">
                
                @forelse ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <a class="card card-dashboard-product d-block" href="{{ route('dashboard-product-detail', $product->id) }}" >
                            <div class="card-body">
                                <img src="{{ Storage::url($product->gallery->first()->image ?? '') }}" class="w-100 mb-2"/>
                                <div class="product-title">{{ $product->name }}</div>
                                <div class="product-category">{{ $product->category->name }}</div>
                            </div>
                        </a>
                    </div>    
                @empty
                    <div class="col-12">
                        <div class="row d-flex justify-content-center">
                            <p>You don't have product to sell. Post your product and get the money!</p> 
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="{{ route('home') }}" class="btn btn-success">Add Product</a>
                        </div>
                    </div>
                @endforelse
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('addon-script')
{{-- Additional JS --}}
@endpush
