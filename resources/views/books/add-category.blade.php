@extends('layouts.app-in')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('book-category') }}">Category</a>
        </li>
        <li class="breadcrumb-item active">Add Category</li>
    </ol>
    
    @if(session()->has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('successMessage') }}
        </div>
    @endif

    @if(session()->has('errorMessage'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('errorMessage') }}
        </div>
    @endif

    <form method="POST" action="{{ route('add-books-category') }}">
        @csrf

        <div class="form-group row">
            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

            <div class="col-md-6">
                <input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category') }}">

                @if ($errors->has('category'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

            <div class="col-md-6">
                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}">

                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>
@endsection
