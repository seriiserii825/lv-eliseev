@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h2>User: {{ $user->name }}</h2>
                        <h3>Email: {{ $user->email }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
