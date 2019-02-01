@extends('layouts.app-in')

@include('includes.datetimepicker')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Books</a>
		</li>
		<li class="breadcrumb-item active">Add Book</li>
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

	<form method="POST" action="{{ route('add-books') }}">
		@csrf
		
		<div class="row">
			
			<div class="col-md-6">

				<div class="form-group row">
					<label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

					<div class="col-md-6">
						<select id="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" required autofocus>
							<option value=""></option>
							@foreach($categories as $item)
								<option value="{{ $item['id'] }}" {{ ($item['id'] == old('category_id')) ? 'selected' : '' }}>{{ $item['category'] }}</option>
							@endforeach
						</select>

						@if ($errors->has('category_id'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('category_id') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

					<div class="col-md-6">
						<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}">

						@if ($errors->has('title'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

					<div class="col-md-6">
						<input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" value="{{ old('author') }}">

						@if ($errors->has('author'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('author') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="publisher" class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

					<div class="col-md-6">
						<input id="publisher" type="text" class="form-control{{ $errors->has('publisher') ? ' is-invalid' : '' }}" name="publisher" value="{{ old('publisher') }}" required>

						@if ($errors->has('publisher'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('publisher') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="published_date" class="col-md-4 col-form-label text-md-right">{{ __('Published Date') }}</label>

					<div class="col-md-6">
						<input id="published_date" type="text" name="published_date" value="{{ old('published_date') }}" class="form-control{{ $errors->has('published_date') ? ' is-invalid' : '' }} datepicker" autocomplete="off">

						@if ($errors->has('published_date'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('published_date') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="edition" class="col-md-4 col-form-label text-md-right">{{ __('Edition') }}</label>

					<div class="col-md-6">
						<input id="edition" type="text" class="form-control{{ $errors->has('edition') ? ' is-invalid' : '' }}" name="edition" value="{{ old('edition') }}" required>

						@if ($errors->has('edition'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('edition') }}</strong>
							</span>
						@endif
					</div>
				</div>

			</div><!-- /.col-md-6 -->

			<div class="col-md-6">

				<div class="form-group row">
					<label for="isbn" class="col-md-4 col-form-label text-md-right">{{ __('ISBN') }}</label>

					<div class="col-md-6">
						<input id="isbn" type="text" class="form-control{{ $errors->has('isbn') ? ' is-invalid' : '' }}" name="isbn" value="{{ old('isbn') }}" required>

						@if ($errors->has('isbn'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('isbn') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

					<div class="col-md-6">
						<input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required>

						@if ($errors->has('price'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('price') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="purchasing_date" class="col-md-4 col-form-label text-md-right">{{ __('Purchasing Date') }}</label>

					<div class="col-md-6">
						<input id="purchasing_date" type="text" name="purchasing_date" value="{{ old('purchasing_date') }}" class="form-control{{ $errors->has('purchasing_date') ? ' is-invalid' : '' }} datepicker" autocomplete="off" required />

						@if ($errors->has('purchasing_date'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('purchasing_date') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="number_of_pages" class="col-md-4 col-form-label text-md-right">{{ __('Number of pages') }}</label>

					<div class="col-md-6">
						<input id="number_of_pages" type="text" class="form-control{{ $errors->has('number_of_pages') ? ' is-invalid' : '' }}" name="number_of_pages" value="{{ old('number_of_pages') }}" required>

						@if ($errors->has('number_of_pages'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('number_of_pages') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="number_of_copies" class="col-md-4 col-form-label text-md-right">{{ __('Number of copies') }}</label>

					<div class="col-md-6">
						<input id="number_of_copies" type="text" class="form-control{{ $errors->has('number_of_copies') ? ' is-invalid' : '' }}" name="number_of_copies" value="{{ old('number_of_copies') }}" required>

						@if ($errors->has('number_of_copies'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('number_of_copies') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="shelf" class="col-md-4 col-form-label text-md-right">{{ __('Shelf') }}</label>

					<div class="col-md-6">
						<input id="shelf" type="text" class="form-control{{ $errors->has('shelf') ? ' is-invalid' : '' }}" name="shelf" value="{{ old('shelf') }}" required>

						@if ($errors->has('shelf'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('shelf') }}</strong>
							</span>
						@endif
					</div>
				</div>

			</div><!-- /.col-md-6 -->

			<div class="col-md-6">
				
				<div class="form-group row">
					<label for="shelf" class="col-md-4 col-form-label text-md-right"></label>
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">
							{{ __('Submit') }}
						</button>
					</div>
				</div>

			</div><!-- /.col-md-6 -->
			<div class="col-md-6">
			</div><!-- /.col-md-6 -->

		</div>
	
	</form>
@endsection
