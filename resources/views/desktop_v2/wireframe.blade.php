<!DOCTYPE html>
<html lang="id" class="{{ isset($login) ? 'gray-lightest' : '' }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THUNDER - APIManager</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ '/css/app.css' }}" media="screen" title="no title" charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

		<link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		@yield('css')
	</head>
	<body class="font-black fixed-worksppace">
		<nav class="navbar navbar-fixed-top navbar-light bg-faded">
			<div class="container">
				<a class="navbar-brand" href="#">
					<h3 class="m-b-0">Thunder APIManager</h3>
					<p class="text-12 m-b-0">oauth2 for thunder apps</p>
				</a>
				<div class="dropdown pull-xs-right pt-s">
					<button class="btn dropdown-toggle menu-user text-14" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> &nbsp; {{Session::get('whoami')['name']}}
					</button>
					<div class="dropdown-menu menu-user-item text-14" aria-labelledby="dropdownMenu1">
						<a class="dropdown-item" href="{{route('auth.getLogout')}}">Sign Out</a>
					</div>
				</div>
			</div>
		</nav>
		<section class="">
			@yield('content')
		</section>

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/assets/script.css"></script>
		@yield('js')
	</body>
</html>
