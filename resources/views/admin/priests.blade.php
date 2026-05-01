@extends('app.adminlayout')

@section('content')
<div class="container mt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage Priests</h1>
    <p class="mb-4">Below is the complete list of registered priests.<br>Use the action buttons to view priest profiles, edit details, or remove inactive accounts..</p>
    <a href="{{ route('admin.addpriest') }}" class="btn btn-warning mb-3">Add Priests</a>

    <div style="overflow-x: auto;">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Priests List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        {{-- <table id="priests-table" class="table table-bordered table-striped"> --}}
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Rating</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gotra</th>
                    <th>Specialization</th>
                    <th>Experience</th>
                    <th>Availability</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($priests as $priest)
                <tr>
                    <td>{{ $priest->id }}</td>
                    <td>{{ $priest->name }}</td>
                    <td>{{ $priest->age }}</td>
                    <td>{{ $priest->rating }}</td>
                    <td>{{ $priest->phone }}</td>
                    <td>{{ $priest->email }}</td>
                    <td>{{ $priest->gotra }}</td>
                    <td>{{ $priest->specialization }}</td>
                    <td>{{ $priest->experience }} years</td>
                    <td>{{ $priest->availability }}</td>
                    <td>{{ Str::limit($priest->address, 30) }}</td>
                    <td>
                        @if($priest->image)
                            <img src="{{ asset('storage/' . $priest->image) }}" alt="Image" width="60">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.priests.edit', $priest->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.priests.destroy', $priest->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this priest?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#priests-table').DataTable();
});
</script>
@endpush
