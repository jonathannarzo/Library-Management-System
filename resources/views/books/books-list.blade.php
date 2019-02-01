@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Books</a>
		</li>
		<li class="breadcrumb-item active">List</li>
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
	
	<div class="row">
		<div class="col-md-12" style="text-align:right;">
			<a class="btn btn-primary btn-sm" href="{{ route('add-books-form') }}"><i class="fas fa-fw fa-plus"></i> Add Book</a>
		</div>
	</div>

	<p></p>

	<table class="table table-sm table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Author</th>
				<th>Publisher</th>
				<th>Pub Date</th>
				<th>No. Copies</th>
				<th>Remaining</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if(count($books) > 0)
				@foreach($books as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->title }}</td>
						<td>{{ $item->author }}</td>
						<td>{{ $item->publisher }}</td>
						<td>{{ $item->published_date }}</td>
						<td>{{ $item->number_of_copies }}</td>
						<td>{{ $item->remaining_copies }}</td>
						<td>
							<a class="btn btn-primary btn-sm" href="{{ route('edit-book', ['bookId' => $item->id]) }}">Edit</a>
							<a class="btn btn-primary btn-sm" href="{{ route('borrow-form', ['bookId' => $item->id]) }}">Borrow</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="8">No record found.</td>
				</tr>
			@endif
		</tbody>
	</table>

	{{ $books->links() }}

@endsection
