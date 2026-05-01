@extends('app.layout')
@section('content')

<section class="py-5" style="padding-bottom: 120px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center my-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Select Your Priest</h5>
            </div>
        </div>

        <div class="row gx-4 gy-5 justify-content-center">
            @forelse($priests as $priest)
                <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
                    <div class="card card-span rounded-3 shadow-lg border-0 flex-fill d-flex flex-column justify-content-between">

                        {{-- Priest Image --}}
                        <img
                            class="img-fluid rounded-top object-fit-cover"
                            style="height: 250px; width: 100%; object-fit: cover;"
                            src="{{ $priest->image
                                ? asset('storage/' . $priest->image)
                                : asset('assets/img/gallery/placeholder.png') }}"
                            alt="{{ $priest->name }}"
                        >

                        {{-- Priest Info --}}
                        <div class="card-body text-start">
                            <h5 class="fw-bold text-1000 text-truncate mb-2">{{ $priest->name }}</h5>

                            <div class="mb-2">
                                <small class="text-muted">Age: </small>
                                <span class="text-primary fw-bold">{{ $priest->age }} years</span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Experience: </small>
                                <span class="text-primary fw-bold">{{ $priest->experience_years }} years</span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Gotra: </small>
                                <span class="text-primary fw-bold">{{ $priest->gotra }}</span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Specialization: </small>
                                <span class="text-primary">{{ Str::limit($priest->specialization ?? 'N/A', 200) }}</span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Rating: </small>
                                <span class="text-warning">
                                    <i class="fas fa-star"></i> {{ $priest->rating ?? 'N/A' }}/5
                                </span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Availability: </small>
                                <span class="badge {{ $priest->availability ? 'bg-success' : 'bg-danger' }}">
                                    {{ $priest->availability ? 'Available' : 'Not Available' }}
                                </span>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="card-footer bg-transparent border-0 pt-0 pb-4 px-3">
                            <div class="d-grid gap-2">
                                {{-- <form action="{{ route('booking.add', ['id' => $priest->id, 'type' => 'priest']) }}" method="POST"> --}}
                                    {{-- @csrf
                                   <button type="submit"
                                        class="btn btn-danger btn-lg w-100 shadow-sm"
                                        {{ $priest->availability ? '' : 'disabled' }}>
                                        <i class="fas fa-calendar-check me-2"></i> Book Now
                                    </button>
                                </form> --}}

                                {{-- <a href="tel:{{ $priest->phone }}" class="btn btn-outline-primary btn-lg w-100">
                                    <i class="fas fa-phone me-2"></i> Call
                                </a> --}}
                            </div>
                            <div class="mt-2 text-center">
                                <small class="text-muted">{{ $priest->phone }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">No priests available at the moment.</h5>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
