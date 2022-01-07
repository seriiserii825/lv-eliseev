@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body p-5">
                        <ul>
                            <li class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc">
                                <strong>Name:</strong> <span>{{ $advertsCategory->name }}</span></li>
                            <li class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc">
                                <strong>Slug:</strong> <span>{{ $advertsCategory->slug }}</span></li>
                            <li class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc">
                                <strong>Parent:</strong><span>{{ $advertsCategory->parent ? $advertsCategory->parent->name : 'Root' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <p class="mb-5"><a href="{{ route('admin.adverts_attributes.create', ['category_id' => $advertsCategory->id]) }}" class="btn btn-success">Add Attribute</a></pc>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Sort</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Required</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse ($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td>{{ $attribute->sort }}</td>
                    <td>
                        <a href="{{ route('admin.adverts_attributes.show', [$advertsCategory, $attribute]) }}">{{ $attribute->name }}</a>
                    </td>
                    <td>{{ $attribute->type }}</td>
                    <td>{{ $attribute->required ? 'Yes' : '' }}</td>

                    <td class="d-flex">
                        <a class="btn btn-success mr-2" href="{{ route('admin.adverts_attributes.edit', [$attribute]) }}">Edit</a>

                        <form action="{{ route('admin.adverts_attributes.destroy', $attribute->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">None</td></tr>
            @endforelse

            </tbody>
        </table>
    </div>
@endsection
