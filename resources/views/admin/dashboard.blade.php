@extends('layouts.admin')
@section('content')
<div class="block-header">
    <h2>USER MANAGEMENT</h2>
</div>
@include('partials.widget')
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    @can('user-create')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add User
                    </button>
                    @endcan
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ROLES</th>
                                <th>CREATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @can('user-delete')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#userDelete-{{ $user->id }}">
                                                Delete
                                            </button>
                                        @endcan
                                    </td>
                                </tr>

                                <!-- Edit user modal -->
                                <div class="modal fade" id="userEdit-{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.update', $user->id) }}" method="POST">

                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">

                                                        <div class="body">
                                                            <label for="email_address">User Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="name"
                                                                        value="{{ $user->name }}" class="form-control"
                                                                        name="name" placeholder="Role">
                                                                </div>
                                                            </div>
                                                            <label for="email_address">User Email</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="email" id="email"
                                                                        value="{{ $user->email }}" class="form-control"
                                                                        name="email" placeholder="Role">
                                                                </div>
                                                            </div>
                                                            <label for="role">Roles</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <select name="roles[]" class="form-control show-tick"
                                                                        multiple data-selected-text-format="count">
                                                                        @foreach ($roles as $value)
                                                                            <option value="{{$value->name}}">{{$value->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
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

                                <!-- Delete user modal -->
                                <div class="modal fade" id="userDelete-{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">

                                                        <div class="body">
                                                            <label for="email_address">Are you sure you want to delete 
                                                                {{ $user->name }} ?</label>

                                                        </div>
                                                    </div>
                                                </div>
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

    <!-- Add user modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="body">
                            <label for="name">Name</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name"
                                        placeholder="Name">
                                </div>
                            </div>
                            <label for="password">Email</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Enter email">
                                </div>
                            </div>
                            <label for="role">Role</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="roles[]" class="form-control show-tick" multiple
                                        data-selected-text-format="count">
                                        @foreach ($roles as $value)
                                        <option value="{{$value->name}}">{{$value->name}}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <label for="password">Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Enter Password">
                                </div>
                            </div>
                            <label for="password">Confirm Password</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" name="password_confirmation" id="password"
                                        class="form-control" placeholder="Confirm Password">
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
