@extends('layouts.master')

@section('title')
	Longitude
@stop

@section('content')

<div id="main-container">
	<div class="container">
		<p class="title">
			Longitude
		</p>
		<p class="subtitle">
			Easily track your staff in real time.
		</p>

		<p>
			<a href="{{ route('user.register') }}" class="btn btn-primary btn-lg" id="register-btn">Register new &raquo;</a>
		</p>
		<p>
			<small>or</small> <a id="home-sign-in-btn" href="{{ route('user.login') }}">Sign in</a>
		</p>
	</div>
</div>

<div class="container">
	@include('partials/footer')
</div>

@stop