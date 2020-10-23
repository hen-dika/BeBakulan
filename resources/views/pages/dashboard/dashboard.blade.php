@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up" >
    <div class="container-fluid">

        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Look what you have made today!
            </p>
        </div>

        <div class="dashboard-content">
            <div class="row">

                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Customer
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($customer) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Revenue
                            </div>
                            <div class="dashboard-card-subtitle">
                                $ {{ number_format($revenue) }}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Transaction
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($transaction_count) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transactions</h5>
                    
                    @forelse ($transaction_data as $transaction)
                       <a class="card card-list d-block" href="{{ route('dashboar-transaction-detail', $transaction->id) }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ Storage::url($transaction->priduct->gallery->first()->image ?? '') }}" class="w-75"/>
                                    </div>
                                    <div class="col-md-4">
                                        {{ $transaction->product->name }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->transaction->user->name }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->created_at }}
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="/images/dashboard-arrow-right.svg" alt=""/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <p>You don't have transaction.</p> 
                            </div>
                            <div class="row d-flex justify-content-center">
                                <a href="{{ route('home') }}" class="btn btn-success">Shop Now</a>
                            </div>
                        </div>       
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
{{-- Additional JS --}}
@endpush