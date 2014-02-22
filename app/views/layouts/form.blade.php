<!DOCTYPE html>
<html>
<head>
	<title>
		@section('title')
			Pizzasys
		@show
	</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<script type="text/javascript">
		var BASE_URL = '{{ url("/") }}';
	</script>

	<?= stylesheet_link_tag() ?>
	<?= javascript_include_tag() ?>
</head>
<body class="form">
	<div class="form-container">
		@include('partials.alerts_small')

		<div class="card">
			<h2>
				@section('title')
					Pizzasys
				@show
			</h2>

			<hr />

			@yield('content')
		</div>

		@include('partials.footer')
	</div>
</body>
</html>
