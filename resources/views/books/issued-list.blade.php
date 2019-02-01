@extends('layouts.app-in')

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('issued-books') }}">Issued Books</a>
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

	<table class="table table-sm table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Member</th>
				<th>Book</th>
				<th>No. Copies</th>
				<th>Issued</th>
				<th>Due</th>
				<th>Returned</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if(count($booksIssued) > 0)
				@foreach($booksIssued as $item)
					<tr>
						<td>{{ $members[$item->member_id] }}</td>
						<td>{{ $item->books->title }}</td>
						<td>{{ $item->number_of_copies }}</td>
						<td>{{ $item->date_issued }}</td>
						<td>{{ $item->due_date }}</td>
						<td>{{ ( ! empty($item->date_returned)) ? $item->date_returned : '---' }}</td>
						<td>
							@if (empty($item['date_returned']))
							<a class="btn btn-primary btn-sm" href="{{ route('return-books-form', [ 'issuedId' => $item->id ]) }}">Return</a>
							@else
							Returned
							@endif
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7">No record found.</td>
				</tr>
			@endif
		</tbody>
	</table>
	
	{{ $booksIssued->links() }}

@endsection
