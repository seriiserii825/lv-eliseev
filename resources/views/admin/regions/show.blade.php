@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body p-5">
                        <ul>
                            <li  class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc"><strong>Name:</strong> <span>{{ $region->name }}</span></li>
                            <li class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc"><strong>Slug:</strong> <span>{{ $region->slug }}</span></li>
                            <li class="d-flex justify-content-between mb-3 pb-2" style="border-bottom: 1px solid #ccc"><strong>Parent:</strong><span>{{ $region->parent ? $region->parent->name : 'Root' }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if(count($regions))
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-dark table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">N#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Parent</th>
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
                                <td class="d-flex align-items-center">
                                    <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-success mr-3">Edit</a>
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
                </div>
            </div>
            @else
            <h3 style="font-size: 3rem;">No <strong>children</strong> regions</h3>
        @endif
    </div>
@endsection
