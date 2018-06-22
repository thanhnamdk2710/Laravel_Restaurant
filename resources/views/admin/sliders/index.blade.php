@extends('layouts.app')

@section('title', 'All Slider')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.message')

                    <a href="{{ route('sliders.create') }}" class="btn btn-primary">Add New</a>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="sliders" style="width:100%">
                                    <thead class=" text-primary">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($sliders as $key => $slider)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $slider->title }}</td>
                                                <td>{{ $slider->sub_title }}</td>
                                                <td>{{ $slider->image }}</td>
                                                <td>{{ $slider->created_at }}</td>
                                                <td>{{ $slider->updated_at }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('sliders.edit', $slider->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form
                                                        action="{{ route('sliders.destroy', $slider->id) }}"
                                                        method="POST" id="delete-form-{{ $slider->id }}" style="display: none"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="
                                                            if(confirm('Are you sure? You want to delete this?')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $slider->id }}')
                                                                .submit();
                                                            } else {
                                                                event.preventDefault();
                                                            }"
                                                    >
                                                        <i class="material-icons">delete_forever</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sliders').DataTable();
        } );
    </script>
@endpush
