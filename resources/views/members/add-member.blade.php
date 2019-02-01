@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('members-list') }}">Members</a>
		</li>
		<li class="breadcrumb-item active">Add Member</li>
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

	<form method="POST" action="{{ route('add-member') }}">
		@csrf

		<div class="form-group row">
			<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

			<div class="col-md-6">
				<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

				@if ($errors->has('name'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

			<div class="col-md-6">
				<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

				@if ($errors->has('email'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

			<div class="col-md-6">
				<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

				@if ($errors->has('password'))
					<span class="invalid-feedback" role="alert">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

			<div class="col-md-6">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

			<div class="col-md-6">
				@php
					$old_role = (is_null(old('role'))) ? [] : old('role');
				@endphp
				
				@foreach($roles as $item)
					<div class="form-check">
						<input class="form-check-input{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role[]" type="checkbox" value="{{ $item['id'] }}" id="role_{{ $item['id'] }}" {{ (in_array($item['id'], $old_role)) ? 'checked' : ''}} >
						<label class="form-check-label" for="role_{{ $item['id'] }}">
							{{ $item['name'] }}
						</label>
					</div>
				@endforeach

				@if ($errors->has('role'))
					<span class="invalid-feedback" role="alert" style="display: block;">
						<strong>{{ $errors->first('role') }}</strong>
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