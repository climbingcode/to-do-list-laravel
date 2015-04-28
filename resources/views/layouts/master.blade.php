<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8"/>
		<meta name="_token" content="{{ csrf_token() }}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">

			
		<title>Welcome to TODOParrot</title>

		{!! HTML::style('css/app.css') !!}
		{!! HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css')!!}

	
	</head>

	<body>
		
		<nav id="navBar" class="navbar navbar-inverse navbar-static-top">
			<div class="container-fluid">
				@if (Auth::guest())
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/auth/login') }}">Login</a></li> 
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					</ul>
				@else
					<h4 class="navbar-text">Welcome back, {{ Auth::user()->name }}</h4>
					<div class="nav navbar-nav navbar-right">
					<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					</div>
				@endif
			</div>
		</nav>

		@if (Session::has('flash_message'))
			<div class="alert laert-success">{{ Session::get('flash_message') }}</div>
		@endif

	  	@yield('content')

	  	{!! HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') !!}
	  	{!! HTML::script('js/jquery-ui.min.js') !!}
 		{!! HTML::script('js/all.js') !!}
 		{!! HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js')!!}

	</body>

</html>