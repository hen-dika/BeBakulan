@extends('layouts/admin')

@section('title','Category | BeBakulan - we provide whatever you need')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="container-fluid">

        <div class="dashboard-heading">
            <h2 class="dashboard-title">Category</h2>
            <p class="dashboard-subtitle">
                Create category product
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
                            
                            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="image">Category Name</label>
                                            <input class="form-control" name="name" id="image" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Categoty Icon</label>
                                            <input type="file" name="image" id="image" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('category.index') }}" class="btn btn-outline-secondary btn-block">Cancel</a>
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
{{-- Additional JS --}}
@endpush