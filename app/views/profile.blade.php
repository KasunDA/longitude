@extends('layouts.master')

@section('title')
	Profile
@stop

@section('content')

<div class="container">
	<table class="table table-striped">
		<colgroup>
			<col style="width: 90%;" />
			<col style="width: 10%;" />
		</colgroup>

		<thead>
			<th>API tokens</th>
			<th></th>
		</thead>

		<tbody>
			@foreach ($apiTokens as $token)
				<tr>
					<td>{{ $token->token }}</td>
					<td style="text-align: right;">
						<a href="{{route('token.revoke', $token->id)}}" class="btn btn-xs btn-danger">
							Revoke
						</a>
					</td>
				</tr>
			@endforeach

			@if ($apiTokens->isEmpty())
				<tr>
					<td>You have no API tokens</td>
					<td></td>
				</tr>
			@endif
		</tbody>
	</table>

	<a href="{{route('token.new')}}" class="btn btn-success">
		Add API token
	</a>
	
	@include('partials.footer')
</div>

@stop