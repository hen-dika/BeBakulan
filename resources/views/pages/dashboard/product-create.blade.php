@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Add New Product</h2>
            <p class="dashboard-subtitle">
                Create your own product
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
                    <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" aria-describedby="name" name="name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categories_id">Product Category</label>
                                            <select class="form-control" id="categories_id" aria-describedby="name" name="categories_id" value="Papel La Casa">
                                            <option disabled>Choose one ...</option>    
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" aria-describedby="price" name="price" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="4" class="form-control" >
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="thumbnails">Thumbnails</label>
                                            <input type="file" multiple class="form-control pt-1" id="thumbnails" aria-describedby="thumbnails" name="image"/>
                                            <small class="text-muted">
                                                You can select more than one file
                                            </small>
                                        </div>
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block px-5">
                                    Save Now
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('plugins/ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endpush
