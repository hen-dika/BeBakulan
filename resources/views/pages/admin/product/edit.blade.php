@extends('layouts/admin')

@section('title','Product | BeBakulan - we provide whatever you need')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="container-fluid">

        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product</h2>
            <p class="dashboard-subtitle">
                Post product to get money
            </p>
        </div>

        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('product.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price">Product Price</label>
                                            <input type="number" class="form-control" name="price" id="price" value="{{ $item->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Product Description</label>
                                            <textarea name="description" id="description" class="form-control">{!! $item->description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="categories_id">Category</label>
                                            <select name="categories_id" id="categories_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($item->categories_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="users_id">Seller</label>
                                            <select name="users_id" id="users_id" class="form-control">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ ($item->users_id == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary btn-block">Cancel</a>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success btn-block">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </form>
                        </div>
                    </div>
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