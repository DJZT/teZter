<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TeZteR</title>

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/material.min.css">
	<link rel="stylesheet" href="/css/roboto.min.css">
	<link rel="stylesheet" href="/css/ripples.min.css">

	@yield('css')

</head>
<body>

	@include('client.header')
	@if($errors->all())
	<div class="alert alert-danger">
		<ul>
		@foreach($errors->all('<li>:message</li>') as $error)
			{!! $error !!}
		@endforeach
		</ul>
	</div>
	@endif

	<div class="container">
		@yield('content')
	</div>

	@include('client.footer')

	<!-- Scripts -->
	<script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/material.min.js')}}"></script>
	<script src="{{asset('js/ripples.min.js')}}"></script>

	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>

	@yield('js')
</body>
</html>
