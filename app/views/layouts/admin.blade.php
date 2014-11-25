<!doctype html>
<html>
<head>

	<meta charset="utf-8">
	<title>{{ $title }}</title>

	{{ HTML::style('css/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap/css/bootstrap-responsive.min.css') }}

    {{ HTML::style('admin/css/datepicker.css') }}
    {{ HTML::style('admin/css/timepicker.css') }}

    {{ HTML::style('admin/css/style.css') }}

    {{ HTML::script('css/bootstrap/js/jquery-1.9.1.min.js') }}
    {{ HTML::script('css/bootstrap/js/bootstrap.min.js') }}

</head>
<body class="body">
	<div class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-inner">
			<div class="container">
				<a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a href="#" class="brand">伊绰美容</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="active_dashboard">{{ link_to('admin/index', 'Home') }}</li>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">顾客管理<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to('customers', '顾客信息') }}</li>
								<li>{{ link_to('customers/addcustomer', '增加新顾客') }}</li>
							</ul>
						</li>

						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">护理项目管理<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to('nurse', '护理信息') }}</li>
								<li>{{ link_to('nurse/addnurse', '增加新护理项目') }}</li>
							</ul>
						</li>

						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">员工管理<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to('employee', '员工信息') }}</li>
								<li>{{ link_to('employee/addemployee', '增加新员工信息') }}</li>	
							</ul>							
						</li>

						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">消费记录管理<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to('revenue', '消息记录') }}</li>	
							</ul>							
						</li>	
					</ul>
					<!-- End Master Report -->
					<ul class="nav pull-right">
						@if(Sentry::check())
							<?php $current_user = Sentry::getUser(); ?>
							<li><a href="#">管理员: {{ $current_user->first_name }} &nbsp;</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown"></li>
							<li>{{ link_to('admin/logout', '安全退出') }}</li>
						@endif
					</ul>

				</div>
				<!-- /.nav-collapse -->
			</div>
		</div>
		<!-- /navbar-inner -->
	</div>

	<div class="clear-fix"> &nbsp; </div>

	@yield('subnavigation')

	<div class="container-fluid sr-container">
		<div class="row-fluid">

			@if(Session::has('success'))
				<div class="span6 alert alert-success">
					{{ Session::get('success') }}
				</div>
			@endif

			@if(Session::has('error'))
				<div class="span6 alert alert-error">
					{{ Session::get('error') }}
				</div>
			@endif

			@if ($errors->any())
				<div class="span6 alert alert-error">
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
				</div>
			@endif

			<div class="span12">
				<div class="content-container">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">

$(document).ready(function()
{
	$(".active_admin").addClass('active');
});

</script>

</body>
</html>