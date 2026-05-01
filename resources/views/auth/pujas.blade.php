@extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Popular Puja Services</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            @forelse($pujas as $puja)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="card card-span rounded-3 shadow-lg border-0 flex-fill d-flex flex-column justify-content-between">

                        {{-- Product Image --}}
                        <img
                            class="img-fluid rounded-top object-fit-cover"
                            style="height: 250px; width: 100%; object-fit: cover;"
                            src="{{ $puja->image
                                ? asset('storage/' . $puja->image)
                                : asset('assets/img/gallery/placeholder.png') }}"
                            alt="{{ $puja->name }}"
                        >

                        {{-- Product Info --}}
                        <div class="card-body text-start">
                            <h5 class="fw-bold text-1000 text-truncate mb-2">{{ $puja->name }}</h5>
                            <div class="mb-2">
                                <span class="text-warning me-2"><i class="fas fa-tag"></i></span>
                                <span class="text-primary">
                                    {{ $puja->tag ?? Str::limit($puja->description ?? 'No description', 100) }}
                                </span>
                            </div>
                            <span class="text-1000 fw-bold" style="font-size: 18px;">{{ number_format($puja->price, 2) }} INR*</span>
                        </div>

                        {{-- Add to Booking Button --}}
                        <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-3">

                            <form action="{{ route('booking.add',  ['id' => $puja->id, 'type' => 'puja']) }}" method="POST" class="d-grid">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $puja->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-danger btn-lg w-100 shadow-sm">
                                    <i class="fas fa-calendar-check me-2"></i> Book Now
                                </button>
                            </form>
                            {{-- <a href="{{ route('booking.start', ['puja' => $puja->id]) }}"
                                class="btn btn-danger btn-lg w-100 shadow-sm d-grid">
                                    <i class="fas fa-calendar-check me-2"></i> Book Now
                             </a> --}}


                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">No puja services available.</h5>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
