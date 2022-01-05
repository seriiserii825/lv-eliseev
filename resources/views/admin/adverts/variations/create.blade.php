@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">New</div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.advert_variations.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sort" class="col-md-3 col-form-label">Sort</label>
                                <div class="col-md-6">
                                    <input id="sort" type="text"
                                           class="form-control @error('sort') is-invalid @enderror" name="sort"
                                           value="{{ old('sort', 1) }}" required>
                                    @error('sort')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="d-flex justify-content-end w-100 col-md-12">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
