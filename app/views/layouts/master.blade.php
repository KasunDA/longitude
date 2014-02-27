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

		@if (Auth::check())
			var API_TOKEN = '{{ Auth::user()->internalToken()->token }}';
		@endif
	</script>

	<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi-5W95aAeVGEgiJbXlnH08lrZ9yle7uY&amp;sensor=false&amp;v=3&amp;region=LT">
	</script>

	<script type="text/javascript"
		src="http://cdn.sockjs.org/sockjs-0.3.min.js">
	</script>

	<?= stylesheet_link_tag() ?>
	<?= javascript_include_tag() ?>

	<!-- Image styles -->
	<style type="text/css">
		#main-container {
			background-image: url({{ url("/") }}/assets/map_dots.png);
		}
	</style>
</head>
<body>
	@include('partials.navigation')
	@include('partials.alerts_big')

	@yield('content')
</body>
</html>
