<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TeZteR</title>

	<link rel="stylesheet" href="/css/bootstrap.min.css">

	@yield('css')

</head>
<body>

	@include('client.header')

			<div class="container">
				@yield('content')
			</div>


	@include('client.footer')

	<!-- Scripts -->
	<script src="/js/jquery-1.11.3.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>

	@yield('js')
</body>
</html>
