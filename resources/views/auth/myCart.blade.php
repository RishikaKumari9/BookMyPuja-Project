
@extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-3">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Your Cart</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            <div class="col-lg-12">
                @php
                    $cart = session('cart', []);
                    $grandTotal = 0;
                    $finalTotal = 0;
                @endphp

                @if(empty($cart))
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center py-5">
                            <h5 class="text-muted mb-3">Your cart is empty.</h5>
                            <a href="{{ route('products') }}" class="btn btn-primary">Browse Products</a>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">

                                @foreach($cart as $id => $item)
                                    @php
                                        // Get full product details from database
                                        $product = \App\Models\Product::find($id);
                                        if (!$product) continue;

                                        $quantity = $item['quantity'] ?? 1;
                                        $price = $product->price ?? 0;
                                        $total = $price * $quantity;
                                        $grandTotal += $total;
                                    @endphp

                                    <div class="list-group-item d-flex align-items-center px-4 py-3">
                                        <!-- Product Image -->
                                        <div class="me-3" style="width: 90px;">
                                            <img
                                                src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/gallery/placeholder.png') }}"
                                                alt="{{ $product->name }}"
                                                class="img-fluid rounded"
                                                style="height: 70px; width: 70px; object-fit: cover;"
                                            >
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-fill">
                                            <h6 class="mb-1 text-truncate">{{ $product->name }}</h6>
                                            <div class="small text-muted">
                                                {{ $product->tag ?? \Illuminate\Support\Str::limit($product->description ?? 'No description', 100) }}
                                            </div>
                                        </div>

                                        <!-- Price + Quantity + Remove -->
                                        <div class="text-end me-3" style="min-width: 150px;">
                                            <div class="mb-2 fw-bold">₹{{ number_format($price, 2) }}</div>

                                            <div class="d-flex justify-content-end align-items-center">
                                                <!-- Update Quantity -->
                                                <form action="{{ route('cart.update', $product->id) }}" method="POST" class="d-flex align-items-center me-2">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $quantity }}" class="form-control form-control-sm" style="width: 70px;" min="1">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" style="background-color: #faad28;">Update</button>
                                                </form>

                                                <!-- Remove Product -->
                                                <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="ms-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Remove">
                                                        <i class="fas fa-trash me-2"></i>Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Line Total -->
                                        <div class="text-end" style="min-width: 120px;">
                                            <div class="small text-muted">Subtotal</div>
                                            <div class="fw-bold">₹{{ number_format($total, 2) }}</div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Totals Section -->
                        <div class="card-footer bg-white border-0">
                            @php
                                $tax = round($grandTotal * 0.05, 2);
                                $shipping = $grandTotal > 500 ? 0 : 50;
                                $finalTotal = $grandTotal + $tax + $shipping;
                            @endphp

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('products') }}" class="btn btn-outline-primary" style="background-color: #faad28;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Continue Shopping
                                    </a>
                                </div>
                                 <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('booking.view') }}" class="btn btn-outline-primary" style="background-color: #faad28;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Check MyBookings
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="me-4 text-end">
                                            <div class="small text-muted">Subtotal</div>
                                            <div class="fw-bold">₹{{ number_format($grandTotal, 2) }}</div>

                                            <div class="small text-muted mt-1">Tax (5%)</div>
                                            <div class="fw-bold">₹{{ number_format($tax, 2) }}</div>

                                            <div class="small text-muted mt-1">Shipping</div>
                                            <div class="fw-bold">₹{{ number_format($shipping, 2) }}</div>
                                        </div>

                                        <div class="ms-4 text-end">
                                            <div class="small text-muted">Total</div>
                                            <div class="fs-5 fw-bold">₹{{ number_format($finalTotal, 2) }}</div>

                                            <form action="{{ route('checkout.process') }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{ $finalTotal }}">
                                                {{-- <button type="submit" class="btn btn-danger btn-lg">
                                                    Proceed to Checkout
                                                </button> --}}
                                                <button id="rzp-button1" class="btn btn-danger btn-lg">
                                                    Proceed to Checkout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "{{ $finalTotal * 100 }}", // Amount is in currency subunits. Default currency is INR. Hence, 100 refers to 100 paise
    "currency": "INR",
    "name": "Book My Puja",
    "description": "Test Payment",
    "handler": function (response){
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('payment') }}";

        var csrf = document.createElement('input');
        csrf.name = "_token";
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        var input = document.createElement('input');
        input.name = "razorpay_payment_id";
        input.value = response.razorpay_payment_id;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
};
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
@endsection

