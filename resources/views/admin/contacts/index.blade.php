@extends('layouts.app')

@section('title', 'All Contact Message')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.message')

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">All Contact Message</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="sliders" style="width:100%">
                                    <thead class=" text-primary">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Send At</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $key => $contact)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->subject }}</td>
                                                <td>{{ $contact->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('contacts.show', $contact->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                        <i class="material-icons">details</i>
                                                    </a>
                                                    <form
                                                        action="{{ route('contacts.destroy', $contact->id) }}"
                                                        method="POST" id="delete-form-{{ $contact->id }}" style="display: none"
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
                                                                document.getElementById('delete-form-{{ $contact->id }}')
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
