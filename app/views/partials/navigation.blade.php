<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{ link_to(route('index'),'Longitude',['class'=>'navbar-brand']) }}
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li>
						{{ link_to(route('user.logout'), 'Logout ('.Auth::user()->username.')', []) }}
					</li>
				@else
					<li>
						{{ link_to(route('user.login'), 'Login', []) }}
					</li>
					<li>
						{{ link_to(route('user.register'), 'Register', []) }}
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>