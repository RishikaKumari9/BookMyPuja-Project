@extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Popular Items</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="card card-span rounded-3 shadow-lg border-0 flex-fill d-flex flex-column justify-content-between">

                        {{-- Product Image --}}
                        <img
                            class="img-fluid rounded-top object-fit-cover"
                            style="height: 250px; width: 100%; object-fit: cover;"
                            src="{{ $product->image
                                ? asset('storage/' . $product->image)
                                : asset('assets/img/gallery/placeholder.png') }}"
                            alt="{{ $product->name }}"
                        >

                        {{-- Product Info --}}
                        <div class="card-body text-start">
                            <h5 class="fw-bold text-1000 text-truncate mb-2">{{ $product->name }}</h5>
                            <div class="mb-2">
                                <span class="text-warning me-2"><i class="fas fa-tag"></i></span>
                                <span class="text-primary">
                                    {{ $product->tag ?? Str::limit($product->description ?? 'No description', 100) }}
                                </span>
                            </div>
                            <span class="text-1000 fw-bold" style="font-size: 18px;">{{ number_format($product->price, 2) }} INR*</span>
                        </div>

                        {{-- Add to Cart Button --}}
                        <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-3">

                            <form action="{{ route('cart.add',['id' => $product->id, 'type' => 'product']) }}" method="POST" class="d-grid">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-danger btn-lg w-100 shadow-sm">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">No products available.</h5>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

{{-- ------------------------------------------------------------------------------------------------------------------- --}}


