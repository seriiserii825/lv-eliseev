@extends('layouts.app')

@section('content')
    @include('layouts.partials.tabs')
    <ul>
        @foreach($users as $user)
            <li>
                <strong>{{ $user->name }}: </strong>
                <span>{{ $user->email }}</span>
            </li>
        @endforeach
    </ul>
@endsection
