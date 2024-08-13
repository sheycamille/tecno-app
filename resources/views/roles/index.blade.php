@extends('layouts.admin')

@section('content')
<div class="block-header">
    <h2>ROLE MANAGEMENT</h2>
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
                    @can('role-create')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleCreate">
                            Add Role
                        </button>
                    @endcan
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>PERMISSIONS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row">{{$role->id}}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @php
                                            $perms = $role::where('roles.id', $role->id)
                                                ->with('permissions')
                                                ->first();
                                        @endphp
                                        @foreach ($perms->permissions as $perm)
                                            <label class="badge badge-secondary text-dark text-wrap">{{ $perm->name }}</label>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('role-delete')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#roleDelete-{{ $role->id }}">
                                                Delete
                                            </button>
                                        @endcan

                                    </td>
                                </tr>

                                <!-- Edit role modal -->
                                <div class="modal fade" id="roleEdit-{{ $role->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('update.role', $role->id) }}" method="POST">

                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">

                                                        <div class="body">
                                                            <label for="email_address">Role Name</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="name"
                                                                        value="{{ $role->name }}" class="form-control"
                                                                        name="role" placeholder="Role">
                                                                </div>
                                                            </div>
                                                            <label for="permissions">Permissions</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    @php
                                                                        $rolePermissions = DB::table(
                                                                            'role_has_permissions',
                                                                        )
                                                                            ->where(
                                                                                'role_has_permissions.role_id',
                                                                                $role->id,
                                                                            )
                                                                            ->pluck(
                                                                                'role_has_permissions.permission_id',
                                                                                'role_has_permissions.permission_id',
                                                                            )
                                                                            ->all();
                                                                    @endphp
                                                                    <select name="permission[]" class="form-control show-tick"
                                                                        multiple data-selected-text-format="count">
                                                                        @foreach ($permission as $value)
                                                                            <option
                                                                                @if (in_array($value->id, $rolePermissions)) selected @endif
                                                                                value="{{ $value->name }}">
                                                                                {{ $value->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @csrf
                                                @method('PUT')

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
                                <div class="modal fade" id="roleDelete-{{ $role->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">

                                                @csrf
                                                <div class="modal-body">
                                                    <div class="body">

                                                        <div class="body">
                                                            <label for="email_address">Are you sure you want to delete the
                                                                {{ $role->name }} role?</label>

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
                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="body">
                            <div class="body">
                                <label for="email_address">Role Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="role"
                                            placeholder="Role">
                                    </div>
                                </div>
                                <label for="permissions">Assign Permissions</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="permissions[]" class="form-control show-tick" multiple
                                            data-selected-text-format="count">
                                            @foreach ($permission as $value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
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
