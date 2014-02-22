@extends('layouts.form')

@section('title')
	Login
@stop

@section('content')

{{ Form::open(array('route' => 'user.login')) }}
	<div class="form-group">
		{{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}

		@if($incorrectLogin)
			<div class="form-tooltip">
				Incorrect username or password
			</div>
		@endif
	</div>
	
	<div class="form-group">
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
	</div>

	{{ Form::submit('Login', array('class'=>'btn btn-lg btn-primary btn-block'))}}

	<div class="form-footer">
		or <a href="{{route('user.register')}}">Register</a>
	</div>
{{ Form::close() }}

@stop