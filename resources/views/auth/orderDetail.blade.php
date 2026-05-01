@extends('app.layout')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    {{-- <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Orders</h2>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Orders</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs --> --}}

    <section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-5">
                {{-- <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Order Details</h5> --}}
            </div>
        </div>

    <div class="container mt-5" >
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        <div class="card-body">
            <p><strong>Customer Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Customer Address:</strong> {{ Auth::user()->address  }}</p>
            {{-- <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p> --}}
            <p><strong>Payment Status:</strong> {{ $order->status }}
            @if($order->status === 'pending')
                 @php $grandTotal = 0; @endphp
                @foreach($orderDetails as $item)
                    @php $total = $item->price * $item->quantity; @endphp
                    @php $grandTotal += $total; @endphp
                @endforeach
                {{-- <button id="rzp-button1" class="btn btn-success">Pay ₹{{ number_format($grandTotal, 2) }}</button> --}}
            @endif
            </p>
            <hr>
            <h5>Items:</h5>
            <table id="orderDetailsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>📦 Product Name</th>
                        <th>🔢 Quantity</th>
                        <th>💰 Price</th>
                        <th>🧾 Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($orderDetails as $item)
                        @php $total = $item->price * $item->quantity; @endphp
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>₹{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                        @php $grandTotal += $total; @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                        <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#orderDetailsTable').DataTable({
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

        var orderInput = document.createElement('input');
        orderInput.name = "order_id";
        orderInput.value = "{{ $order->id }}";
        form.appendChild(orderInput);

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
