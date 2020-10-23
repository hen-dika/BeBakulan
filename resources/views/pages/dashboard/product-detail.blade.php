@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $product->name }}</h2>
            <p class="dashboard-subtitle">
                Product Details
            </p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    
                    <form action="{{ route('dashboard-product-update', $product->id) }}">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{ $product->name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categories_id">Category Product</label>
                                            <select name="categories_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $product->categories_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="{{ $product->price }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control">
                                                {!! $product->description !!}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{ route('dashboard-product') }}" class="btn btn-outline-secondary btn-block px-5">
                                                    Back to Product
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-success btn-block px-5">
                                                    Update Product
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">    
                                
                                @foreach ($product->gallery as $gallery)
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="{{ Storage::url($gallery->image ?? '') }}" alt="" class="w-100"/>
                                            <a class="delete-gallery" href="{{ route('dashboard-gallery-delete', $gallery->id) }}">
                                                <img src="{{ url('images/icon-delete.svg') }}" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    
                                    <form action="{{ route('dashboard-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12 mt-3">
                                            <input type="hidden" name="products_id" value="{{ $product->id }}">
                                            <input type="file" id="file" style="display: none;" multiple name="image" onchange="form.submit()"/>
                                            <button class="btn btn-secondary btn-block" type="button" onclick="thisFileUpload()">
                                                Add Photo
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
{{-- Additional JS --}}
    <script src="{{ url('plugins/ckeditor5/ckeditor.js') }}"></script>
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endpush
