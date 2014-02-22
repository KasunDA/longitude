@extends('layouts.form')

@section('title')
	Register
@stop

@section('content')

{{ Form::model($user, array('route' => 'user.create')) }}
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	<div class="form-group">
		{{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Username')) }}
	</div>
	
	<div class="form-group">
		{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
	</div>

	<div class="form-group">
		{{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
	</div>

	{{ Form::submit('Register', array('class'=>'btn btn-lg btn-primary btn-block'))}}

	<div class="form-footer">
		or <a href="#">Login</a>
	</div>
{{ Form::close() }}

@stop