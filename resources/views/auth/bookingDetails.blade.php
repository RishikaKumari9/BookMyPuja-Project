@extends('app.layout')

@section('content')
<main id="main">



    <section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-5">
                {{-- <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Order Details</h5> --}}
            </div>
        </div>

    <div class="container mt-5" >
    <h1>Booking Details</h1>
    <div class="card">
        <div class="card-header">
            Booking #{{ $booking->id }}
        </div>
        <div class="card-body">
            <p><strong>Customer Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Customer Address:</strong> {{ Auth::user()->address  }}</p>

            {{-- <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p> --}}
            <p><strong>Payment Status:</strong> {{ $booking->status }}
            @if($booking->status === 'pending')
                 @php $grandTotal = 0; @endphp
                @foreach($bookingDetails as $item)
                    @php $total = $item->price * $item->quantity; @endphp
                    @php $grandTotal += $total; @endphp
                @endforeach
                {{-- <button id="rzp-button1" class="btn btn-success">Pay ₹{{ number_format($grandTotal, 2) }}</button> --}}
            @endif
            </p>
            <hr>
            <h5>Items:</h5>
            <table id="bookingDetailsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        {{-- <th>📦 Puja Name</th> --}}
                        <th>🔢 Puja Date</th>
                        <th>👨‍💼 Priest Name</th>
                        <th>💰 Price</th>
                        <th>🧾 Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = $booking->total_amount; @endphp

                        <tr>
                            {{-- <td>{{ $booking->puja_name }}</td> --}}
                            <td>{{  $booking->booking_date }}</td>
                            <td>{{ $booking->priest_name }}</td>
                            <td>₹{{ number_format($booking->price ?? $booking->total_amount, 2) }}</td>
                            <td>₹ {{ number_format($booking->total_amount, 2) }}</td>
                        </tr>
                        {{-- @php $grandTotal += $total; @endphp --}}
                    {{-- @endforeach --}}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                        <td><strong>₹{{ number_format($booking->total_amount, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#bookingDetailsTable').DataTable({
                        "paging": true,
                        "searching": false,
                        "info": false,
                        "lengthChange": false,
                        "columnDefs": [
                            { "orderable": false, "targets": [1, 2, 3] }
                        ]
                    });
                });
            </script>
            @endpush
            <hr>
        </div>
    </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "{{ config('services.razorpay.key') }}",
    "amount": "{{ $grandTotal * 100 }}", // Amount is in currency subunits. Default currency is INR. Hence, 100 refers to 100 paise
    "currency": "INR",
    "name": "Laravel 12 Demo",
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

        var bookingInput = document.createElement('input');
        bookingInput.name = "booking_data";
        bookingInput.value = '{{ json_encode(session("bookingData")) }}';
        form.appendChild(bookingInput);


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
