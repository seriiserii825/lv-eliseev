@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
        <div class="admin__filter">
            <form method="GET" action="?">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-md-3 col-form-label">Id</label>
                            <input id="id" type="text" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name" class="col-md-3 col-form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email" class="col-md-3 col-form-label">Email</label>
                            <input id="email" type="text" class="form-control" name="email"
                                   value="{{ request('email') }}">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="status" class="col-md-3 col-form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}"
                                            @if($status === request('status')) selected @endif >{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="role" class="col-md-3 col-form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}"
                                            @if($role === request('role')) selected @endif >{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group row mt-5">
                            <div class="d-flex justify-content-end w-100 col-md-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="admin__header">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-5">New</a>
        </div>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->isWait())
                            <span class="badge badge-primary">{{ $user->status }}</span>
                        @endif
                        @if($user->isActive())
                            <span class="badge badge-success">{{ $user->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($user->isAdmin())
                            <span class="badge badge-danger">{{ $user->role }}</span>
                        @else
                            <span class="badge badge-info">{{ $user->role }}</span>
                        @endif
                    </td>
                    <td class="d-flex align-items-center">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success mr-3">Edit</a>

                        <form action="{{ route('admin.users.verify') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button class="btn btn-primary mr-3">Verify</button>
                        </form>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
