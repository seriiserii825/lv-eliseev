@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">New</div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.adverts_categories.store') }}">
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
                                <label for="parent_id"
                                       class="col-md-3 col-form-label">Parents</label>
                                <div class="col-md-6">
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value=""></option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">
                                                @for($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <h3 class="section-title">Attributes:</h3>
                            @foreach($attributes as $attribute)
                                <div class="form-group row">
                                    <div class="col-md-1 col-form-label">
                                        <input
                                            {{ $attribute->value ? 'checked' : null }} data-id="{{ $attribute->id }}"
                                            type="checkbox" class="ingredient-enable">
                                        <input type="hidden" value="{{ $attribute->id }}" name="attribute_id[]">
                                    </div>
                                    <div class="col-md-2 col-form-label">{{ $attribute->name }}</div>
                                    <div class="col-md-6">
                                            <textarea class="form-control" name="variants[]" id="variants" cols="30"
                                                      rows="8">
                                                {{ \App\Helpers\StringHelper::fromJson($attribute->variants) }}
                                            </textarea>
                                    </div>
                                </div>
                            @endforeach

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
