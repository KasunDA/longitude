@if(Session::has('flash_message'))
	@if(Session::get('flash_type') === 'notice')
		<div class="alert alert-info">
	@elseif(Session::get('flash_type') === 'success')
		<div class="alert alert-success">
	@elseif(Session::get('flash_type') === 'error')
		<div class="alert alert-danger">
	@endif

		<div class="container">
			{{ Session::get('flash_message') }}
		</div>
	</div>
@endif