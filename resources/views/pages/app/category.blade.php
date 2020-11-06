@extends('layouts/app')

@section('title','Category | BeBakulan - Choose your favorit category product')

@section('content')

<div class="page-content page-categories">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $categoryAOS=0 @endphp
                @forelse ($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $categoryAOS += 100 }}" >
                    <a class="component-categories d-block" href="{{ route('category-detail', $category->slug) }}">
                        <div class="categories-image">
                            <img src="{{ Storage::url($category->image) }}" alt="Gadgets Categories" class="w-100" />
                        </div>
                        <p class="categories-text">
                            {{ $category->name }}
                        </p>
                    </a>
                </div>
                @empty
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $categoryAOS += 100 }}" >
                    <a class="component-categories d-block" href="{{ route('category-detail', $category->slug) }}">
                        <p class="categories-text">
                           No category are shown
                        </p>
                    </a>
                </div>
                @endforelse
                

            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                
                @php $productAOS = 0 @endphp
                @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $productAOS += 100 }}">
                    <a class="component-products d-block" href="{{ route('product-detail', $product->slug) }}">
                        <div class="products-thumbnail">
                            <div class="products-image" style=" 
                                @if($product->gallery)
                                            background-image: url('{{ Storage::url($product->gallery->first()->image) }}');
                                        @else
                                            background-color: #eee;
                                        @endif
                            "></div>
                        </div>
                        <div class="products-text">
                            {{ $product->name }}
                        </div>
                        <div class="products-price">
                            ${{ $product->price }}
                        </div>
                    </a>
                </div>
                    
                @empty
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $productAOS += 100 }}">
                    <a class="component-products d-block" href="{{ route('product-detail', $product->slug) }}">
                        <div class="products-text">
                            No product to displayed
                        </div>
                        <div class="products-price">
                            {{ $product->price }}
                        </div>
                    </a>
                </div>
                @endforelse
            </div>
            
            <div class="row d-flex justify-content-center">
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('addon-script')
{{-- Additional js --}}
@endpush