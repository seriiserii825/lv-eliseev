@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
        <div class="admin__header">
            <a href="{{ route('admin.adverts_categories.create') }}" class="btn btn-primary mb-5">New</a>
        </div>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Parent</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @for($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                        <a href="{{ route('admin.adverts_categories.show', $category) }}">{{ $category->name }}</a>
                    </td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-primary mr-3" href="{{ route('admin.adverts_categories.edit', $category) }}">Edit</a>
                        <form action="{{ route('admin.adverts_categories.destroy', $category->id) }}" method="post">
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
