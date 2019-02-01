<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'LMS') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/jquery.min.js') }}" defer></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
	<script src="{{ asset('js/jquery.easing.min.js') }}" defer></script>
	<script src="{{ asset('js/sb-admin.min.js') }}" defer></script>
	@stack('scripts')

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/sb-admin.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	@stack('styles')

</head>

<body id="page-top">

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

		<a class="navbar-brand mr-1" href="{{ route('dashboard') }}">Libarary Management System</a>

		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

		<!-- Navbar Search -->
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search Book" aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
		</form>

		<!-- Navbar -->
		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown"
				role="button" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false">
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
				<div class="dropdown-menu dropdown-menu-right"
					aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#">Settings</a> <a
						class="dropdown-item" href="#">Activity Log</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal"
						data-target="#logoutModal">Logout</a>
				</div>
			</li>
		</ul>

	</nav>

	<div id="wrapper">
		@php
            $userRoles = ( ! empty(Auth::user()->roles)) ? Auth::user()->toArray()['roles'] : array();
            $userRoleNameArr = array_column($userRoles, 'name');
		@endphp
		<!-- Sidebar -->
		<ul class="sidebar navbar-nav">
			@if( ! empty(array_intersect($userRoleNameArr, ['admin','librarian'])))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('dashboard') }}">
					<i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('members-list') }}">
					<i class="fas fa-fw fa-users"></i> <span>Users</span>
				</a>
			</li>
			@endif

			@if( ! empty(array_intersect($userRoleNameArr, ['admin'])))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('roles-list') }}">
					<i class="fas fa-fw fa-users-cog"></i> <span>Roles</span>
				</a>
			</li>
			@endif

			<li class="nav-item">
				<a class="nav-link" href="{{ route('books-list') }}">
					<i class="fas fa-fw fa-book"></i> <span>Books</span>
				</a>
			</li>

			@if( ! empty(array_intersect($userRoleNameArr, ['admin','librarian'])))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('book-category') }}">
					<i class="fas fa-fw fa-table"></i> <span>Category</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('issued-books') }}">
					<i class="fas fa-fw fa-arrow-alt-circle-left"></i> <span>Issued / Return Book</span>
				</a>
			</li>
			@endif
		</ul>

		<div id="content-wrapper">

			<div class="container-fluid">
				@yield('content')
			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<footer class="sticky-footer">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright © LMS {{ date('Y') }}</span>
					</div>
				</div>
			</footer>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready
					to end your current session.
					<form id="logoutForm" action="{{ route('logout') }}" method="post" style="display: none;">
						@csrf
					</form>
					</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button"
						data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="javascript:document.getElementById('logoutForm').submit()">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

</body>

</html>
