@extends('layouts.admin')
@section('content')
<div class="block-header">
    <h2>THESIS MANAGEMENT</h2>
</div>
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="header">
                    @can('thesis-create')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleCreate">
                            Create Thesis
                        </button>
                    @endcan
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TITLE</th>
                                <th>DESCRIPTION</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($theses as $thesis)
                                <tr>
                                    <th scope="row">{{$thesis->id}}</th>
                                    <td>{{ $thesis->title }}</td>
                                    <td>{{ $thesis->description }}</td>
                                    <td>
                                        @can('thesis-edit')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#roleEdit-{{ $thesis->id }}">
                                                Edit
                                            </button>
                                        @endcan

                                        @can('thesis-delete')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#roleDelete-{{ $thesis->id }}">
                                                Delete
                                            </button>
                                        @endcan

                                    </td>
                                </tr>

                                <!-- Edit role modal -->
                                <div class="modal fade" id="roleEdit-{{ $thesis->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Thesis</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('theses.update', $thesis->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">
                                                        <div class="body">
                                                            <label for="email_address">Title</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="name"
                                                                        value="{{ $thesis->title }}" class="form-control"
                                                                        name="title" placeholder="Role">
                                                                </div>
                                                            </div>
                                                            <label for="Description">Description</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <textarea rows="4" class="form-control no-resize" name="description" placeholder="{{$thesis->description}}"></textarea>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete role modal -->
                                <div class="modal fade" id="roleDelete-{{ $thesis->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('roles.destroy', $thesis->id) }}" method="POST">

                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">

                                                        <div class="body">
                                                            <label for="email_address">Are you sure you want to delete the
                                                                {{ $thesis->name }} role?</label>

                                                        </div>
                                                    </div>
                                                </div>
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Yes, I'm Sure</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Table -->

    <!-- Add role modal -->
    <div class="modal fade" id="roleCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Thesis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('theses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="body">
                            <div class="body">
                                <label for="title">Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Title">
                                    </div>
                                </div>
                                <label for="Description">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" class="form-control no-resize" name="description" placeholder="Descripe your thesis"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
