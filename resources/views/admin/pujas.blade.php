@extends('app.adminlayout')

@section('content')
<div class="container mt-4">

     <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Manage Puja Services</h1>
    <p class="mb-4">Below is the complete list of Puja Services.<br>Use the action buttons to view Puja Services, edit details, or remove inactive Services..</p>
    <a href="{{ route('admin.addpuja') }}" class="btn btn-warning mb-3">Add Puja Service</a>

    {{-- <table id="pujas-table" class="table table-bordered table-striped"> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Puja Services List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pujas as $puja)
            <tr>
                <td>{{ $puja->id }}</td>
                <td>{{ $puja->name }}</td>
                <td>{{ Str::limit($puja->description, 50) }}</td>
                <td>{{ $puja->price }}</td>
                <td>
                    @if($puja->image)
                        <img src="{{ asset('storage/' . $puja->image) }}" alt="Image" width="60">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.pujas.edit', $puja->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pujas.destroy', $puja->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this puja service?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    $('#products-table').DataTable();
});
</script>
@endpush
