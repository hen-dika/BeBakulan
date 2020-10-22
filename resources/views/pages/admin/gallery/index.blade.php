@extends('layouts/admin')

@section('title','Gallery | BeBakulan - Best marketplace')

@push('addon-style')
<link rel="stylesheet" type="text/css" href="{{ url('plugins/DataTables/datatables.min.css') }}"/>
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="container-fluid">

        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product Gallery</h2>
            <p class="dashboard-subtitle">
                Post beautifull your photo product
            </p>
        </div>

        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('gallery.create') }}" class="btn btn-outline-danger btn-sm mb-4">
                                <i class="fas fa-plus"></i> New Gallery
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover w-100" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
    <script type="text/javascript" src="{{ url('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        var datatable = $('#dataTable').DataTable({
            processing: true,
            serverside: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'product.name', name: 'product.name' },
                { 
                    data: 'action', 
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
    @endpush