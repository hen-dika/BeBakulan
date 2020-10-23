@extends('layouts/dashboard')

@section('title','Dashboard|BeBakulan')

@push('addon-script')
{{-- Additional Style --}}
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $transaction->code }}</h2>
            <p class="dashboard-subtitle">
                Transaction Details
            </p>
        </div>
        
        <div class="dashboard-content" id="transactionDetails">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img src="{{ Storage::url($transaction->product->gallery->first()->image ?? '') }}" alt="" class="w-100 mb-3"/>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Customer Name</div>
                                            <div class="product-subtitle">{{ $transaction->transaction->user->name }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Product Name</div>
                                            <div class="product-subtitle">
                                                {{ $transaction->product->name }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Date of Transaction
                                            </div>
                                            <div class="product-subtitle">
                                                {{ $transaction->transaction->created_at }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Payment Status</div>
                                            <div class="product-subtitle text-danger">
                                                {{-- {{ status }} --}}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Total Amount</div>
                                            <div class="product-subtitle">$ {{ number_format($transaction->transaction->total_price) }}</div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">Mobile</div>
                                            <div class="product-subtitle">
                                                {{ $transaction->transaction->user->phone_number }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5>
                                            Shipping Informations
                                        </h5>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address 1</div>
                                                <div class="product-subtitle">
                                                   {{ $transaction->transaction->user->address_one }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Address 2</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->address_two }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Province</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->email }}
                                                    {{ App\Models\Province::find($transaction->transaction->user->provinces_id) }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">City</div>
                                                <div class="product-subtitle">
                                                    {{-- {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }} --}}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Postal Code</div>
                                                <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">Country</div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->country }}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="product-title">Shipping Status</div>
                                                        <select name="status" id="status" class="form-control" v-model="status">
                                                            <option value="unpaid">Unpaid</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="shiping">Shipping</option>
                                                            <option value="success">Success</option>
                                                        </select>
                                                    </div>
                                                    <template v-if="status == 'SHIPPING'">
                                                        <div class="col-md-3">
                                                            <div class="product-title">
                                                                Input Resi
                                                            </div>
                                                            <input class="form-control" type="text" name="resi" id="openStoreTrue" v-model="resi"/>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="submit" class="btn btn-success btn-block mt-4">
                                                                Update Resi
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
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
<script src="{{ url('plugins/vue/vue.js') }}"></script>
<script>
    var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
            status: "{{ $transaction->shiping_status }}",
            resi: "{{ $transaction->resi }}",
        },
    });
</script>
@endpush