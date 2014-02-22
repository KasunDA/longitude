@extends('layouts.form')

@section('title')
	Register
@stop

@section('content')

{{ Form::open(array('route' => 'user.register')) }}
	<div class="form-group">
		{{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}

		@if($errors->has('username'))
			<div class="form-tooltip">
				{{ $errors->first('username') }}
			</div>
		@endif
	</div>
	
	<div class="form-group">
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}

		@if($errors->has('password'))
			<div class="form-tooltip">
				{{ $errors->first('password') }}
			</div>
		@endif
	</div>

	<div class="form-group">
		{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}

		@if($errors->has('password_confirmation'))
			<div class="form-tooltip">
				{{ $errors->first('password_confirmation') }}
			</div>
		@endif
	</div>

	{{ Form::submit('Register', array('class'=>'btn btn-lg btn-primary btn-block'))}}

	<div class="form-footer">
		or <a href="{{route('user.login')}}">Login</a>
	</div>
{{ Form::close() }}

@stop