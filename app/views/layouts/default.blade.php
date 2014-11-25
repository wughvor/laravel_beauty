<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width">
	<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'></head>

	{{ HTML::style('css/bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap/css/bootstrap-responsive.min.css') }}
	{{ HTML::script('css/bootstrap/js/jquery-1.9.1.min.js') }}
	{{ HTML::script('css/bootstrap/js/bootstrap.min.js') }}

<body class = "{{ $class }}">
	<div class="container">
		<div class="row-fluid header">
			<div class="span4 logo">
				<a href=""></a>
			</div>
			<div class="span6 menu">
				<ul>

				</ul>
			</div>
		</div>

		<div class="row-fluid content">

			@if(Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('content')
		</div>

	</div>
</body>
</html>