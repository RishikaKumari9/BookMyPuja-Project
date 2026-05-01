{{-- @extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center my-3">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">My Bookings</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            <div class="col-lg-10">
                @php
                    $bookings = session('bookings', []);
                    $grandTotal = 0;
                @endphp

                @if(empty($bookings))
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center py-5">
                            <h5 class="text-muted mb-3">You have no bookings yet.</h5>
                            <a href="{{ route('pujas') }}" class="btn btn-primary">Browse Pooja Services</a>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">

                                @foreach($bookings as $id => $booking)
                                    @php
                                        $puja = \App\Models\Puja::find($id);
                                        if (!$puja) continue;

                                        $quantity = $booking['quantity'] ?? 1;
                                        $price = $puja->price ?? 0;
                                        $total = $price * $quantity;
                                        $grandTotal += $total;
                                    @endphp

                                    <div class="list-group-item px-4 py-3 border-bottom">
                                        <!-- Service Info -->
                                        <div class="row align-items-start">
                                            <div class="col-md-3">
                                                <img
                                                    src="{{ $puja->image ? asset('storage/' . $puja->image) : asset('assets/img/gallery/placeholder.png') }}"
                                                    alt="{{ $puja->name }}"
                                                    class="img-fluid rounded"
                                                    style="height: 100px; width: 100%; object-fit: cover;"
                                                >
                                            </div>

                                            <div class="col-md-3">
                                                <h6 class="mb-2">{{ $puja->name }}</h6>
                                                <div class="small text-muted">
                                                    {{ \Illuminate\Support\Str::limit($puja->description ?? 'No description', 80) }}
                                                </div>
                                                <div class="mt-2 fw-bold">₹{{ number_format($price, 2) }}</div>
                                            </div>

                                            {{-- <!-- Date Selection -->
                                            <div class="col-md-2">
                                                <label class="form-label small fw-bold">Select Date</label>
                                                <form action="{{ route('booking.updateDate', $puja->id) }}" method="POST" class="d-flex flex-column">
                                                    @csrf
                                                    <input
                                                        type="date"
                                                        name="booking_date"
                                                        value="{{ $booking['booking_date'] ?? date('Y-m-d') }}"
                                                        class="form-control form-control-sm"
                                                        min="{{ date('Y-m-d') }}"
                                                        required
                                                    >
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary mt-2" style="background-color: #faad28;">
                                                        Update
                                                    </button>
                                                </form>
                                            </div> --}}

                                            {{-- <!-- Address Input -->
                                            <div class="col-md-2">
                                                <label class="form-label small fw-bold">Address</label>
                                                <form action="{{ route('booking.updateAddress', $puja->id) }}" method="POST" class="d-flex flex-column">
                                                    @csrf
                                                    <input
                                                        type="text"
                                                        name="address"
                                                        value="{{ $booking['address'] ?? '' }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="Enter address"
                                                        required
                                                    >
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary mt-2" style="background-color: #faad28;">
                                                        Update
                                                    </button>
                                                </form>
                                            </div> --}}

                                            <!-- Remove -->
                                            {{-- <div class="col-md-2 text-end">
                                                <form action="{{ route('booking.remove', $puja->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Remove">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </form>
                                                <div class="mt-3 text-end">
                                                    <div class="small text-muted">Total</div>
                                                    <div class="fw-bold">₹{{ number_format($total, 2) }}</div>
                                                </div>
                                            </div> --}}
                                        {{-- </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Totals Section -->
                        <div class="card-footer bg-white border-0">
                            @php
                                $tax = round($grandTotal * 0.05, 2);
                                $finalTotal = $grandTotal + $tax;
                            @endphp

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('pujas') }}" class="btn btn-outline-primary" style="background-color: #faad28;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Continue Browsing
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="me-4 text-end">
                                            <div class="small text-muted">Subtotal</div>
                                            <div class="fw-bold">₹{{ number_format($grandTotal, 2) }}</div>

                                            <div class="small text-muted mt-1">Tax (5%)</div>
                                            <div class="fw-bold">₹{{ number_format($tax, 2) }}</div>
                                        </div>

                                        <div class="ms-4 text-end">
                                            <div class="small text-muted">Total</div>
                                            <div class="fs-5 fw-bold">₹{{ number_format($finalTotal, 2) }}</div>

                                            <form action="{{ route('booking.process') }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{ $finalTotal }}">
                                                <button type="submit" class="btn btn-danger btn-lg">
                                                    Confirm Booking
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

@endsection --}}
















@extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center my-3">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Your Bookings</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            <div class="col-lg-12">
                @php
                    $cart = session('booking', []);
                    $grandTotal = 0;
                    $finalTotal = 0;
                @endphp

                @if(empty($booking))
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center py-5">
                            <h5 class="text-muted mb-3">You have no Bookings.</h5>
                            <a href="{{ route('pujas') }}" class="btn btn-primary">Browse Pooja Services</a>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">

                                @foreach($booking as $id => $item)
                                    @php
                                        // Get full product details from database
                                        $puja = \App\Models\Puja::find($id);
                                        if (!$puja) continue;

                                        $quantity = $item['quantity'] ?? 1;
                                        $price = $puja->price ?? 0;
                                        $total = $price * $quantity;
                                        $grandTotal += $total;
                                    @endphp

                                    <div class="list-group-item d-flex align-items-center px-4 py-3">
                                        <!-- Product Image -->
                                        <div class="me-3" style="width: 90px;">
                                            <img
                                                src="{{ $puja->image ? asset('storage/' . $puja->image) : asset('assets/img/gallery/placeholder.png') }}"
                                                alt="{{ $puja->name }}"
                                                class="img-fluid rounded"
                                                style="height: 70px; width: 70px; object-fit: cover;"
                                            >
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-fill">
                                            <h6 class="mb-1 text-truncate">{{ $puja->name }}</h6>
                                            <div class="small text-muted">
                                                {{ $puja->tag ?? \Illuminate\Support\Str::limit($puja->description ?? 'No description', 100) }}
                                            </div>
                                        </div>

                                        <!-- Price + Quantity + Remove -->
                                        <div class="text-end me-3" style="min-width: 150px;">
                                            <div class="mb-2 fw-bold">₹{{ number_format($price, 2) }}</div>

                                            <div class="d-flex justify-content-end align-items-center">
                                                <!-- Update Quantity -->
                                                {{-- <form action="{{ route('booking.update', $puja->id) }}" method="POST" class="d-flex align-items-center me-2">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $quantity }}" class="form-control form-control-sm" style="width: 70px;" min="1">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" style="background-color: #faad28;">Update</button>
                                                </form> --}}
                                                <!-- Update Date -->

                                                {{-- <form action="{{ route('booking.update', $puja->id) }}" method="POST" class="d-flex align-items-center me-2">
                                                    @csrf --}}
                                                    <input type="date"
                                                    id="date_{{ $id }}"
                                                    value="{{ $item['booking_date'] ?? date('Y-m-d') }}"
                                                    class="form-control form-control-sm"
                                                    style="width: 140px;"
                                                    min="{{ date('Y-m-d') }}"
                                                    required
                                                    >
                                                    {{-- <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" style="background-color: #faad28;">Update</button>
                                                </form> --}}

                                                {{-- <!-- Address Input -->
                                                <form action="{{ route('booking.updateAddress', $puja->id) }}" method="POST" class="d-flex align-items-center me-2">
                                                    @csrf
                                                    <input
                                                        type="text"
                                                        name="address"
                                                        value="{{ $item['address'] ?? '' }}"
                                                        class="form-control form-control-sm"
                                                        placeholder="Enter address"
                                                        style="width: 180px;"
                                                        required
                                                    >
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" style="background-color: #faad28;">
                                                        Update
                                                    </button>
                                                </form> --}}

                                                <!-- Select Priest -->
                                                {{-- <form action="{{ route('booking.selectPriest', $puja->id) }}" method="POST" class="d-flex align-items-center me-2">
                                                    @csrf --}}
                                                    <select id="priest_{{ $id }}"
                                                        class="form-select form-select-sm"
                                                        style="width: 200px;">

                                                    <option value="">Select Priest</option>

                                                    @foreach(\App\Models\Priest::all() as $priest)
                                                        <option value="{{ $priest->name }}">
                                                            {{ $priest->name }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                    {{-- <button type="submit" class="btn btn-sm btn-outline-secondary ms-2" style="background-color: #faad28;">Update</button>
                                                </form> --}}


                                                <!-- Remove Product -->
                                                <form action="{{ route('booking.remove', $puja->id) }}" method="POST" class="ms-1">
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
                                    <a href="{{ route('priests') }}" class="btn btn-outline-primary" style="background-color: #faad28;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        View Priests details
                                    </a>
                                    <a href="{{ route('pujas') }}" class="btn btn-outline-primary" style="background-color: #faad28;">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Continue Shopping
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

                                            <form action="{{ route('booking.process') }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{ $finalTotal }}">
                                                {{-- dd(session('booking')); --}}

                                                <button id="rzp-button2" class="btn btn-danger btn-lg">
                                                    Proceed to Payment
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
    "amount": "{{ $finalTotal * 100 }}",
    "currency": "INR",
    "name": "Book My Puja",
    "description": "Booking Payment",

    "handler": function (response){

        var booking = {};

        @foreach($booking as $id => $item)
            booking[{{ $id }}] = {
                date: document.getElementById('date_{{ $id }}').value,
                priest: document.getElementById('priest_{{ $id }}').value
            };
        @endforeach


        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('bpayment') }}";

        var csrf = document.createElement('input');
        csrf.name = "_token";
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        var pay = document.createElement('input');
        pay.name = "razorpay_payment_id";
        pay.value = response.razorpay_payment_id;
        form.appendChild(pay);

        var book = document.createElement('input');
        book.name = "booking_data";
        book.value = JSON.stringify(booking);
        form.appendChild(book);

        document.body.appendChild(form);
        form.submit();
    }
};

var rzp2 = new Razorpay(options);

document.getElementById('rzp-button2').onclick = function(e){
    rzp2.open();
    e.preventDefault();
}
</script>


@endsection

