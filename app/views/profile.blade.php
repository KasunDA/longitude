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
				@if (!$token->internal)
					<tr>
						<td>{{ $token->token }}</td>
						<td style="text-align: right;">
							<a href="{{route('token.refresh', $token->id)}}" class="btn btn-xs btn-primary">
								Refresh
							</a>
						</td>
					</tr>
				@endif
			@endforeach

			@if ($apiTokens->count() == 1)
				<tr>
					<td>You have no API tokens</td>
					<td></td>
				</tr>
			@endif
		</tbody>
	</table>
	
	@include('partials.footer')
</div>

@stop