@extends('app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Ops!</strong> Houve alguns problemas.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@section ('login_panel_title','Autenticação Obrigatória')
			@section ('login_panel_body')
				<form  role="form" method="POST" action="/auth/login">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<input type="email" placeholder="E-mail" class="form-control" name="email" autofocus  value="{{ old('email') }}">
						</div>
						<div class="form-group">
							<input type="password" placeholder="Senha" class="form-control" name="password" value="">
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Manter conectado.
							</label>
							<label class="navbar-right" style="margin-right: 15px;">
								<a href="/password/email">Redefinir senha</a>
							</label>
						</div>
						<button type="submit" class="btn btn-lg btn-success btn-block" style="margin-right: 15px;">
							Login
						</button>
							<label class="navbar-right" style="margin-right: 10px;">

							</label>

					</fieldset>
				</form>

			@endsection
			@include('widgets.panel', array('as'=>'login', 'header'=>true))
		</div>
	</div>
</div>
@stop