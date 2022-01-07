@extends('layouts.app')
@section('content')
    @include('layouts.partials.tabs')
    <div class="admin-container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="card-block mb-5"><strong>View category: </strong><a href="{{ route('admin.adverts_categories.show', [$category]) }}">{{ $category->name }}</a></h2>
                <div class="card">
                    <div class="card-header">New</div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.adverts_attributes.store', ['category_id' => $category->id]) }}">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="sort" class="col-form-label">Sort</label>
                                <input id="sort" type="text"
                                       class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort"
                                       value="{{ old('sort') }}" required>
                                @if ($errors->has('sort'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-form-label">Type</label>
                                <select id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        name="type">
                                    @foreach ($types as $type => $label)
                                        <option
                                            value="{{ $type }}"{{ $type == old('type') ? ' selected' : '' }}>{{ $label }}</option>
                                    @endforeach;
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="variants" class="col-form-label">Variants</label>
                                <textarea id="variants" type="text"
                                          class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}"
                                          rows="7"
                                          name="variants">{{ old('variants') }}</textarea>
                                @if ($errors->has('variants'))
                                    <span
                                        class="invalid-feedback"><strong>{{ $errors->first('variants') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="required" value="0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="required" {{ old('required') ? 'checked' : '' }}>
                                        Required
                                    </label>
                                </div>
                                @if ($errors->has('required'))
                                    <span
                                        class="invalid-feedback"><strong>{{ $errors->first('required') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
