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
                {{-- <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Orders List</h5> --}}
            </div>
        </div>

    <div class="container mt-5" >
    <h1>Order List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                {{-- <th>Order ID</th> --}}
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Total Amount</th>
                {{-- <th>Address</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>{{ $order->id }}</td> --}}
                <td>{{ Auth::user()->name }}</td>
                <td>{{ $order->created_at }}</td>

                <td>{{ $order->status }}</td>
                <td>₹ {{ number_format($order->total_amount, 2) }}</td>
                {{-- <td>{{ $order->address }}</td> --}}
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">View Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</main>
@endsection
