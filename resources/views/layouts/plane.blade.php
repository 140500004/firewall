<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>Firewall</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
</head>
<body>
	@yield('body')
	<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/JavaScript.js") }}" type="text/javascript"></script>

	<!-- <footer class="page-footer">
		<label>© Copyright  - Marlon Santos - {{ date("Y") }}. Todos os direitos reservados.</label>
	</footer> -->
</body>
</html>

<style>
	footer{

		margin-top: 10px;
		margin-bottom: 20px;
		text-align: center;
	}
</style>