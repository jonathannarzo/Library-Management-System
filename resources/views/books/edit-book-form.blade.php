@extends('layouts.app-in')

@include('includes.datetimepicker')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('books-list') }}">Books</a>
		</li>
		<li class="breadcrumb-item active">Edit Book</li>
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

	<form method="POST" action="{{ route('update-book') }}">
		@csrf
		@method('PUT')
		
		<input type="hidden" name="book_id" value="{{ $book->id }}" />
		<input type="hidden" name="remaining_copies" value="{{ $book->remaining_copies }}" />

		<div class="row">
			
			<div class="col-md-6">

				<div class="form-group row">
					<label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

					<div class="col-md-6">
						@php
							$categoryId = ( ! is_null(old('category_id'))) ? old('category_id') : $book->category_id;
						@endphp
						<select id="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" required autofocus>
							<option value=""></option>
							@foreach($categories as $item)
								<option value="{{ $item['id'] }}" {{ ($item['id'] == $categoryId) ? 'selected' : '' }}>{{ $item['category'] }}</option>
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
						@php
							$title = ( ! is_null(old('title'))) ? old('title') : $book->title;
						@endphp
						<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $title }}">

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
						@php
							$author = ( ! is_null(old('author'))) ? old('author') : $book->author;
						@endphp
						<input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" value="{{ $author }}">

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
						@php
							$publisher = ( ! is_null(old('publisher'))) ? old('publisher') : $book->publisher;
						@endphp
						<input id="publisher" type="text" class="form-control{{ $errors->has('publisher') ? ' is-invalid' : '' }}" name="publisher" value="{{ $publisher }}" required>

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
						@php
							$published_date = ( ! is_null(old('published_date'))) ? old('published_date') : $book->published_date;
						@endphp
						<input id="published_date" type="text" class="form-control{{ $errors->has('published_date') ? ' is-invalid' : '' }} datepicker" name="published_date" value="{{ $published_date }}" autocomplete="off">

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
						@php
							$edition = ( ! is_null(old('edition'))) ? old('edition') : $book->edition;
						@endphp
						<input id="edition" type="text" class="form-control{{ $errors->has('edition') ? ' is-invalid' : '' }}" name="edition" value="{{ $edition }}" required>

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
						@php
							$isbn = ( ! is_null(old('isbn'))) ? old('isbn') : $book->isbn;
						@endphp
						<input id="isbn" type="text" class="form-control{{ $errors->has('isbn') ? ' is-invalid' : '' }}" name="isbn" value="{{ $isbn }}" required>

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
						@php
							$price = ( ! is_null(old('price'))) ? old('price') : $book->price;
						@endphp
						<input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $price }}" required>

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
						@php
							$purchasing_date = ( ! is_null(old('purchasing_date'))) ? old('purchasing_date') : $book->purchasing_date;
						@endphp
						<input id="purchasing_date" type="text" class="form-control{{ $errors->has('purchasing_date') ? ' is-invalid' : '' }} datepicker" name="purchasing_date" value="{{ $purchasing_date }}" autocomplete="off" required>

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
						@php
							$number_of_pages = ( ! is_null(old('number_of_pages'))) ? old('number_of_pages') : $book->number_of_pages;
						@endphp
						<input id="number_of_pages" type="text" class="form-control{{ $errors->has('number_of_pages') ? ' is-invalid' : '' }}" name="number_of_pages" value="{{ $number_of_pages }}" required>

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
						@php
							$number_of_copies = ( ! is_null(old('number_of_copies'))) ? old('number_of_copies') : $book->number_of_copies;
						@endphp
						<input id="number_of_copies" type="text" class="form-control{{ $errors->has('number_of_copies') ? ' is-invalid' : '' }}" name="number_of_copies" value="{{ $number_of_copies }}" required>

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
						@php
							$shelf = ( ! is_null(old('shelf'))) ? old('shelf') : $book->shelf;
						@endphp
						<input id="shelf" type="text" class="form-control{{ $errors->has('shelf') ? ' is-invalid' : '' }}" name="shelf" value="{{ $shelf }}" required>

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
