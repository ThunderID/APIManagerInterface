<!DOCTYPE html>
<html lang="id" class="gray-lightest">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THUNDER - API Manager Interface</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ elixir('css/app.css') }}" media="screen" title="no title" charset="utf-8">
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
	<body class="gray-lightest font-black fixed-worksppace">
		<section class="">
			@yield('content')
		</section>
		
		@include('desktop_v2.components.footer')

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/assets/script.css"></script>
		@yield('js')
	</body>
</html>
