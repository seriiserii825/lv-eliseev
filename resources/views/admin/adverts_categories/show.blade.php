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
    </div>
@endsection
