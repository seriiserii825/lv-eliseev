@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <div class="admin__container">
        <div class="admin__header">
            <a href="{{ route('admin.regions.create') }}" class="btn btn-primary mb-5">New</a>
        </div>
        <h2 class="mb-4">Regions: ({{ $regions_count }})</h2>
        <h2 class="mb-4">Villages: ({{ $regions_village }})</h2>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">N#</th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Parent</th>
                <th scope="col">Children</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($regions as $k=>$region)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $region->id }}</td>
                    <td><a href="{{ route('admin.regions.show', $region) }}">{{ $region->name }}</a></td>
                    <td>{{ $region->slug }}</td>
                    <td>{{ $region->parent ? $region->parent->name : '' }}</td>
                    <td>
                        @if($region->hasChildren())
                            <span class="badge badge-success">Has children {{ $region->hasChildren() }}</span>
                        @else
                            <span class="badge badge-danger">Don't have children</span>
                        @endif
                    </td>
                    <td class="d-flex align-items-center">
                        <form action="{{ route('admin.regions.destroy', $region->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $regions->links() }}
    </div>
@endsection
