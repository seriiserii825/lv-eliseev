@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
        <div class="admin__header">
            <a href="{{ route('admin.advert_variations.create') }}" class="btn btn-primary mb-5">New</a>
        </div>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Sort</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($variations as $variation)
                <tr>
                    <td>{{ $variation->id }}</td>
                    <td>{{ $variation->name }}</td>
                    <td>{{ $variation->slug }}</td>
                    <td>{{ $variation->sort }}</td>
                    <td class="d-flex align-items-center">
                        <a class="btn btn-success mr-3" href="{{ route('admin.advert_variations.edit', $variation->id) }}">Edit</a>
                        <a class="btn btn-success mr-3" href="{{ route('admin.advert_variations.show', $variation->id) }}">Show</a>
                        <form action="{{ route('admin.advert_variations.destroy', $variation) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $variations->links() }}
    </div>
@endsection
