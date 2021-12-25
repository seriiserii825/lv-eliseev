@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
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
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if(Auth::user()->email !== $user->email)
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
                @endif
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
