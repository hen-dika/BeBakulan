@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Store Settings</h2>
            <p class="dashboard-subtitle">
                Make store that profitable
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
                    <form action="{{ route('dashboard-setting-redirect', 'dashboard-setting-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storeName">Store Name</label>
                                            <input type="text" class="form-control" id="storeName" aria-describedby="emailHelp" name="store_name" value="{{ $user->store_name }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($category->id == $user->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_store_open">Store Status</label>
                                            <p class="text-muted">
                                                Is your shop open at this time?
                                            </p>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="store_status" id="openStoreTrue" value="1" {{ ($user->store_status == 1) ? 'checked' : '' }}/>
                                                <label class="custom-control-label" for="openStoreTrue" >Open</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="store_status" id="openStoreFalse" value="0" {{ ($user->store_status == 0) ? 'checked' : '' }}/>
                                                <label class="custom-control-label" for="openStoreFalse">Temporary Close</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Save Now
                                        </button>
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
@endsection

@push('addon-script')
{{-- Additional JS --}}
@endpush