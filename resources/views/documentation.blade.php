<div id="ModalUsuario" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h4>Usuario: <strong id="nome"></strong> </h4>
			</div>
			<div class="modal-body">

				<nav class="navbar navbar-default">
					<ul class="nav nav-pills">
						<li class="active"><a data-toggle="pill" href="#perfil">Perfil</a></li>
						<li><a data-toggle="pill" href="#listaRegras">Lista Regras</a></li>
					</ul>
				</nav>

				<div class="tab-content">
					<div id="perfil" class="tab-pane fade in active">
						{{ Form::model('usuario', ['method' => 'PUT','route' => ['usuario.update', 0]])}}
						<div class="form-group">
							<input name="id_usuario" type="hidden" id="id" value="id">
							{{ Form::label('nome do usuario') }}
							{{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Usuario', 'id' => 'usuario']) }}
						</div>

						<div class="form-group">
							{{ Form::label('nome de login') }}
							{{ Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Nome do Login', 'id' => 'login']) }}
						</div>

						<div class="form-group">
						{{ Form::label('nova senha') }}
						<!-- Form::text('Senha', null, ['class' => 'form-control', 'placeholder' => 'Senha']) -->
							<input class="form-control" placeholder="Nova Senha" name="senha" type="password" id="senha">
						</div>

						<div class="form-group">
						{{ Form::label('Confirme a Senha') }}
						<!--  Form::password('confirme a senha', null, ['class' => 'form-control', 'placeholder' => 'confirme a senha']) -->
							<input class="form-control" placeholder="Confirme a Senha" name="senhac" type="password" id="senhaC">
						</div>

						<div class="form-group">
							<label> Novo Grupo </label>
							<select name="id_grupo" id="id_grupo" class="form-control">
								<option value=""> Selecionar...</option>
								@foreach($Grupos as $g)
									<option value="{{ $g->id_grupo }}"> {{ $g->nome }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							{{ Form::label('Inativar Usuario') }}
							{{ Form::checkbox('status', 'I')}}
						</div>

						<div class="modal-footer">
							{{ Form::button('Deletar', ['class' => 'btn btn-warning']) }}
							{{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
							{{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
							{{ Form::close() }}
						</div>
					</div>

					<div id="listaRegras" class="tab-pane fade">

						@if(empty($RegrasUG))
							<div class="alert alert-danger"> Você não tem nenhuma regra cadastrada, faça primeiro o cadastro da regra. </div>
						@else
							@foreach($RegrasUG as $r)
								{{ Form::model('regras', ['method' => 'PUT','route' => ['regras.update', $r->id_regras]])}}
								<div class="input-group">
									{{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
									{{ Form::text( 'url', $r->url, ['class' => 'form-control', 'placeholder' => 'url']) }}
									{{ Form::label('', '.*', array('class' => 'input-group-addon')) }}
									{{ Form::label('', '', array('class' => 'input-group-btn')) }}
									{{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'),  $r->tipo, array('class' => 'form-control')) }}
									{{ Form::label('', '', array('class' => 'input-group-btn')) }}

									<a class="input-group" href="{{ route('regras.destroy', $r->id_regras) }}">
										{{ Form::label('Deletar', 'Deletar', array('class' => 'form-control btn-warning')) }}
									</a>
									{{ Form::label(' ', ' ', array('class' => 'input-group-btn')) }}
									{{ Form::submit('Atualizar', ['class' => 'form-control btn-success']) }}
									{{ Form::close() }}

								</div>
								<hr>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>