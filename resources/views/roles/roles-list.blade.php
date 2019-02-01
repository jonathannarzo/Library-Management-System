@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('roles-list') }}">Roles</a>
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
			<a class="btn btn-primary btn-sm" href="{{ route('add-roles-form') }}"><i class="fas fa-fw fa-plus"></i> Add Roles</a>
		</div>
	</div>

	<p></p>

	<table class="table table-sm table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			@if( ! empty($roles))
				@foreach($roles as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->description }}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4">No record found.</td>
				</tr>
			@endif
		</tbody>
	</table>

@endsection
