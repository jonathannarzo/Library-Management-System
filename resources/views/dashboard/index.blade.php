@extends('layouts.app-in')

@push('scripts')
<script type="text/javascript">
	var issuedPerDayURL = "{{ route('issued-per-day') }}";
	var issuedPerMonthURL = "{{ route('issued-per-month') }}";
</script>
<script src="{{ asset('js/Chart.min.js') }}" defer></script>
<script src="{{ asset('js/issued-per-day-chart.js') }}" defer></script>
<script src="{{ asset('js/issued-per-month-chart.js') }}" defer></script>
@endpush

@section('content')
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Overview</li>
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

		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-comments"></i>
					</div>
					<div class="mr-5">{{ $new_books }} New Books!</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="#">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>

		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-warning o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-list"></i>
					</div>
					<div class="mr-5">{{ $issued_books }} issued books!</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="#">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>

		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div>
					<div class="mr-5">{{ $today_due_books }} Books due today!</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="#">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>

		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-life-ring"></i>
					</div>
					<div class="mr-5">{{ $due_books }} books not returned!</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="#">
					<span class="float-left">View Details</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>

	</div><!-- /.row -->

	<!-- Area Chart -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-chart-area"></i>
			Issued Books Chart Per Day
		</div>
		<div class="card-body">
			<canvas id="issuedPerDayChart" width="100%" height="30"></canvas>
		</div>
		<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
	</div>

	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-chart-bar"></i>
			Issued Books Chart Per Month
		</div>
		<div class="card-body">
			<canvas id="issuedPerMonthChart" width="100%" height="50"></canvas>
		</div>
		<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
	</div>

@endsection
