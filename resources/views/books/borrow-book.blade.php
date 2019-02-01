@extends('layouts.app-in')

@include('includes.datetimepicker')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('books-list') }}">Books</a>
		</li>
		<li class="breadcrumb-item active">Borrow Books</li>
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

	<form method="POST" action="{{ route('borrow-books') }}">
		@csrf
		
		<input type="hidden" name="book_id" value="{{ $book->id }}">

		<div class="row">

			<div class="col-md-6">
				<div class="form-group row">
					<label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

					<div class="col-md-6">
						<input id="title" type="text" class="form-control" name="title" value="{{ $book->title }}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
					<label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

					<div class="col-md-6">
						<input id="author" type="text" class="form-control" name="author" value="{{ $book->author }}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
					<label for="publisher" class="col-md-4 col-form-label text-md-right">{{ __('Publisher') }}</label>

					<div class="col-md-6">
						<input id="publisher" type="text" class="form-control" name="publisher" value="{{ $book->publisher }}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
					<label for="published_date" class="col-md-4 col-form-label text-md-right">{{ __('Published Date') }}</label>

					<div class="col-md-6">
						<input id="published_date" type="text" class="form-control" name="published_date" value="{{ $book->published_date }}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
					<label for="edition" class="col-md-4 col-form-label text-md-right">{{ __('Edition') }}</label>

					<div class="col-md-6">
						<input id="edition" type="text" class="form-control" name="edition" value="{{ $book->edition }}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
					<label for="isbn" class="col-md-4 col-form-label text-md-right">{{ __('ISBN') }}</label>

					<div class="col-md-6">
						<input id="isbn" type="text" class="form-control" name="isbn" value="{{ $book->isbn }}" disabled="true">
					</div>
				</div>
				
			</div>
			
			<div class="col-md-6">

				<div class="form-group row">
					<label for="member_id" class="col-md-4 col-form-label text-md-right">{{ __('Member') }}</label>

					<div class="col-md-6">
						<select name="member_id" id="member_id" class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}">
							<option value=""></option>
							@foreach($members as $item)
								<option value="{{ $item['id'] }}" {{ ($item['id'] == old('member_id')) ? 'selected' : '' }}>{{ $item['name'] }}</option>
							@endforeach
						</select>
						@if ($errors->has('member_id'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('member_id') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="member_id" class="col-md-4 col-form-label text-md-right">{{ __('Number of Copies') }}</label>

					<div class="col-md-6">
						<select class="form-control{{ $errors->has('number_of_copies') ? ' is-invalid' : '' }}" name="number_of_copies">
							@for($i = 0; $i <= $book->remaining_copies; $i++)
								<option value="{{ $i }}" {{ ($i == old('number_of_copies')) ? 'selected' : '' }}>{{ $i }}</option>
							@endfor
						</select>
						@if ($errors->has('number_of_copies'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('number_of_copies') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="date_issued" class="col-md-4 col-form-label text-md-right">{{ __('Date Issued') }}</label>

					<div class="col-md-6">
						@php
							$date_issued = ( ! is_null(old('date_issued'))) ? old('date_issued') : date('Y-m-d');
						@endphp
						<input id="date_issued" type="text" class="form-control{{ $errors->has('date_issued') ? ' is-invalid' : '' }} datepicker" name="date_issued" value="{{ $date_issued }}" autocomplete="off">
						@if ($errors->has('date_issued'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('date_issued') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group row">
					<label for="due_date" class="col-md-4 col-form-label text-md-right">{{ __('Due Date') }}</label>

					<div class="col-md-6">
						<input id="due_date" type="text" class="form-control{{ $errors->has('due_date') ? ' is-invalid' : '' }} datepicker" name="due_date" value="{{ old('due_date') }}" autocomplete="off">
						@if ($errors->has('due_date'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('due_date') }}</strong>
							</span>
						@endif
					</div>
				</div>

			</div>
			
		</div><!-- /.row -->

		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-2">
				<button type="submit" class="btn btn-primary">
					{{ __('Submit') }}
				</button>
			</div>
		</div>

	</form>
@endsection
