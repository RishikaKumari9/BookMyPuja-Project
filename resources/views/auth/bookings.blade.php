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
    <h1>Booking List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                {{-- <th>Booking ID</th> --}}
                <th>Customer Name</th>
                {{-- <th>Puja Name</th> --}}
                <th>Booking Date</th>
                <th>Priest Name</th>
                <th>Booking Status</th>
                <th>Total Amount</th>
                {{-- <th>Address</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>{{ $booking->id }}</td> --}}
                <td>{{ Auth::user()->name }}</td>
                {{-- <td>{{ $booking->puja->name }}</td> --}}
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->priest_name }}</td>
                {{-- <td>{{ $booking->user_id }}</td> --}}
                <td>{{ $booking->status }}</td>
                <td>₹ {{ number_format($booking->total_amount, 2) }}</td>
                {{-- <td>{{ $booking->address }}</td> --}}
                <td>
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary btn-sm">View Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</main>
@endsection
