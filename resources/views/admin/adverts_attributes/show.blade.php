@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="d-flex flex-row mb-3">
            <a href="{{ route('admin.adverts.categories.attributes.edit', [$advertsCategory, $attribute]) }}"
               class="btn btn-primary mr-1">Edit</a>
            <form method="POST"
                  action="{{ route('admin.adverts.categories.attributes.destroy', [$advertsCategory, $attribute]) }}"
                  class="mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>

        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $advertsCategory->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $advertsCategory->name }}</td>
            </tr>
            <tr>
                <th>Slug</th>
                <td>{{ $advertsCategory->slug }}</td>
            </tr>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
