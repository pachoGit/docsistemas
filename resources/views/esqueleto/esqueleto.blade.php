<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('titulo-pagina')</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/jqvmap/jqvmap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('docsistemas/dist/css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('docsistemas/plugins/summernote/summernote-bs4.min.css') }}">
    </head>


    <body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

	    <!-- Preloader -->
	    <div class="preloader flex-column justify-content-center align-items-center">
		<img class="animation__shake" src="{{ asset('docsistemas/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
	    </div>

	    <!-- Navbar -->
	    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
		    <li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		    </li>
		    <li class="nav-item d-none d-sm-inline-block">
			<a href="index.html" class="nav-link">Inicio</a>
		    </li>
		</ul>

		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
		    <!-- Navbar Search -->
		    <li class="nav-item">
			<a class="nav-link" data-widget="navbar-search" href="#" role="button">
			    <i class="fas fa-search"></i>
			</a>
			<div class="navbar-search-block">
			    <form class="form-inline">
				<div class="input-group input-group-sm">
				    <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
				    <div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
					    <i class="fas fa-search"></i>
					</button>
					<button class="btn btn-navbar" type="button" data-widget="navbar-search">
					    <i class="fas fa-times"></i>
					</button>
				    </div>
				</div>
			    </form>
			</div>
		    </li>

		    <!-- Dos ultimos botones del submenu horizontal -->
		    <li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
			    <i class="fas fa-expand-arrows-alt"></i>
			</a>
		    </li>

		    <li class="nav-item">
			<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
			    <i class="fas fa-th-large"></i>
			</a>
		    </li>
		</ul>
	    </nav>
	    <!-- /.navbar -->

	    <!-- Main Sidebar Container -->
	    <aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="index3.html" class="brand-link">
		    <img src="{{ asset('docsistemas/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		    <span class="brand-text font-weight-light">AdminLTE 3</span>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
		    <!-- Sidebar user panel (optional) -->
		    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
			    <img src="{{ asset('docsistemas/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
			    <a href="#" class="d-block">Alexander Pierce</a>
			</div>
		    </div>

		    <!-- SidebarSearch Form -->
		    <div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
			    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
			    <div class="input-group-append">
				<button class="btn btn-sidebar">
				    <i class="fas fa-search fa-fw"></i>
				</button>
			    </div>
			</div>
		    </div>

		    <!-- Sidebar Menu -->
		    <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			    <!-- Add icons to the links using the .nav-icon class
				 with font-awesome or any other icon font library -->
			    <li class="nav-header">PROCESOS</li>

			    <li class="nav-item">
				<a href="pages/calendar.html" class="nav-link active">
				    <i class="nav-icon far fa-calendar-alt"></i>
				    <p>
					Inicio
				    </p>
				</a>
			    </li>

			    <li class="nav-item">
				<a href="#" class="nav-link">
				    <i class="nav-icon fas fa-tachometer-alt"></i>
				    <p>
					Procesos estratégicos
					<i class="right fas fa-angle-left"></i>
				    </p>
				</a>

				<ul class="nav nav-treeview">
				    <x-item-menu-simple href="#" contenido="Planificación del programa de estudio"/>
				    <x-item-menu-simple href="#" contenido="Gestión de perfil de egresado"/>
				</ul>

			    </li>

			    <li class="nav-item">
				<a href="#" class="nav-link">
				    <i class="nav-icon fas fa-copy"></i>
				    <p>
					Procesos misionales
					<i class="fas fa-angle-left right"></i>
				    </p>
				</a>
				<ul class="nav nav-treeview">
				    <x-item-menu-simple href="#" contenido="Enseñanza y aprendizaje"/>
				    <x-item-menu-simple href="#" contenido="I + D + I"/>
				    <x-item-menu-simple href="#" contenido="Responsabilidad Social"/>
				    <x-item-menu-simple href="#" contenido="Docencia"/>
				    <x-item-menu-simple href="#" contenido="Seguimiento a estudiantes"/>
				    <x-item-menu-simple href="#" contenido="Seguimiento a egresados"/>
				</ul>

			    </li>

			    <li class="nav-item">
				<a href="#" class="nav-link">
				    <i class="nav-icon fas fa-chart-pie"></i>
				    <p>
					Procesos de apoyo
					<i class="right fas fa-angle-left"></i>
				    </p>
				</a>
				<ul class="nav nav-treeview">
				    <x-item-menu-simple href="#" contenido="Bienestar universitario"/>
				    <x-item-menu-simple href="#" contenido="Recursos humanos"/>
				    <x-item-menu-simple href="#" contenido="Infraestructura y mantenimiento"/>
				    <x-item-menu-simple href="#" contenido="Gestión Financiera"/>
				</ul>

			    </li>

			    <li class="nav-item">
				<a href="#" class="nav-link">
				    <i class="nav-icon fas fa-tree"></i>
				    <p>
					Procesos de evaluación y control
					<i class="fas fa-angle-left right"></i>
				    </p>
				</a>
				<ul class="nav nav-treeview">
				    <x-item-menu-simple href="#" contenido="Aseguramiento de calidad"/>
				</ul>

			    </li>
			</ul>

		    </nav>
		    <!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	    </aside>

	    <!-- Content Wrapper. Contains page content -->
	    <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
		    <div class="container-fluid">
			<div class="row mb-2">
			    <div class="col-sm-6">
				<h1 class="m-0">@yield('titulo-pagina')</h1>
			    </div><!-- /.col -->
			    <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				    <li class="breadcrumb-item"><a href="#">Home</a></li>
				    <li class="breadcrumb-item active">Dashboard v1</li>
				</ol>
			    </div><!-- /.col -->
			</div><!-- /.row -->
		    </div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<section class="content">
		    <div class="container-fluid">

			@yield('contenido')

		    </div>
		</section>
	    </div>

	    <footer class="main-footer">
		<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
		All rights reserved.
		<div class="float-right d-none d-sm-inline-block">
		    <b>Version</b> 3.1.0
		</div>
	    </footer>

	    <!-- Control Sidebar -->
	    <aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	    </aside>
	    <!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('docsistemas/plugins/jquery/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('docsistemas/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	 $.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('docsistemas/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/chart.js/Chart.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/sparklines/sparkline.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('docsistemas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<script src="{{ asset('docsistemas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<script src="{{ asset('docsistemas/dist/js/adminlte.js') }}"></script>
	<script src="{{ asset('docsistemas/dist/js/demo.js') }}"></script>
	<script src="{{ asset('docsistemas/dist/js/pages/dashboard.js') }}"></script>
    </body>
</html>


