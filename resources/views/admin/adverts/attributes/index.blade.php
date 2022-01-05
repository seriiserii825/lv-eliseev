@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
        <div class="admin__header">
            <a href="{{ route('admin.adverts_attributes.create') }}" class="btn btn-primary mb-5">New</a>
        </div>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Variants</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td><a href="{{ route('admin.adverts_attributes.show', $attribute->id) }}">{{ $attribute->name }}</a>
                    </td>
                    <td>{{ $attribute->slug }}</td>
                    <td>{{ $attribute->variants }}</td>
                    <td class="d-flex align-items-center">
                        <a href="{{ route('admin.adverts_attributes.edit', $attribute->id) }}" class="btn btn-success mr-3">Edit</a>
                        <form action="{{ route('admin.adverts_attributes.destroy', $attribute->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
