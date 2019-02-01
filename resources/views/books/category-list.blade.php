@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('book-category') }}">Category</a>
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
			<a class="btn btn-primary btn-sm" href="{{ route('add-book-category-form') }}"><i class="fas fa-fw fa-plus"></i> Add Category</a>
		</div>
	</div>

	<p></p>

	<table class="table table-sm table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if(count($categories) > 0)
				@foreach($categories as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->category }}</td>
						<td>{{ $item->description }}</td>
						<td>
							<a class="btn btn-primary btn-sm" href="{{ route('edit-book-category', ['categoryId' => $item->id]) }}">Edit</a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4">No record found.</td>
				</tr>
			@endif
		</tbody>
	</table>

	{{ $categories->links() }}

@endsection
