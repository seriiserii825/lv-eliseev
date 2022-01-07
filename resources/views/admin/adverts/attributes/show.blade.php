@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <h2 class="card-block mb-5"><strong>View category: </strong><a href="{{ route('admin.adverts_categories.show', [$category]) }}">{{ $category->name }}</a></h2>
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.adverts_attributes.edit', [$attribute, 'category' => $category]) }}"
           class="btn btn-primary mr-1">Edit</a>
        <form method="POST"
              action="{{ route('admin.adverts_attributes.destroy', [ $attribute, 'category' => $category]) }}"
              class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <ul class="mb-5">
        <li><strong>Id:</strong> {{ $category->id }}</li>
        <li><strong>Category:</strong> {{ $category->name }}</li>
    </ul>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Variants</th>
            <th>Required</th>
            <th>Sort</th>
        </tr>
        <tr>
            <td>{{ $attribute->id }}</td>
            <td>{{ $attribute->name }}</td>
            <td>{{ $attribute->type }}</td>
            <td>
                <ul>
                    @foreach($attribute->variants as $variant)
                        <li>{{ $variant }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $attribute->required }}</td>
            <td>{{ $attribute->sort }}</td>
        </tr>
        </tbody>
    </table>
@endsection
