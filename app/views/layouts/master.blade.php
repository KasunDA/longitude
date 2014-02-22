<!DOCTYPE html>
<html>
<head>
	<title>
		@section('title')
			Longitude
		@show
	</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<script type="text/javascript">
		var BASE_URL = '{{ url("/") }}';
	</script>

	<?= stylesheet_link_tag() ?>
	<?= javascript_include_tag() ?>
</head>
<body>
	@include('partials.navigation')
	@include('partials.alerts_big')

	@yield('content')
</body>
</html>
