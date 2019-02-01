@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('members-list') }}">Members</a>
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
			<a class="btn btn-primary btn-sm" href="{{ route('add-members-form') }}"><i class="fas fa-fw fa-plus"></i> Add Member</a>
		</div>
	</div>

	<p></p>

	<table class="table table-sm table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($members as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->email }}</td>
					<td>
						<small>
							@foreach($item->roles as $ir)
								{{ $ir->name }} <br />
							@endforeach
						</small>
					</td>
					<td>
						<a class="btn btn-primary btn-sm" href="{{ route('edit-member-form', ['userId' => $item->id]) }}">Edit</a>
						<a class="btn btn-primary btn-sm" href="{{ route('edit-password-form', ['userId' => $item->id]) }}">Change Password</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
