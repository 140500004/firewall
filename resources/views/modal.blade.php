
<!-- Novo Grupo - Inicio -->
    <div id="ModalNovoGrupo" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="fa fa-users"> Novo Grupo</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'grupo')) }}
                    {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Grupo', 'autocomplete' => 'off', 'required' => 'required'])}}
                    {{ Form::token() }}
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                    {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
<!-- Novo Grupo - Fim -->


<!-- Cadastro de Usuario no Grupo -Inicio -->
    <div id="ModalNovoUsuario" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="fa fa-user"> Novo Usuario</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'usuario')) }}
                    <div class="form-group">
                        {{ Form::label('nome do usuario') }}
                        {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Usuario', 'required' => 'required' ]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('nome de login') }}
                        {{ Form::text('login', null, ['class' => 'form-control', 'placeholder' => 'Nome do Login', 'required' => 'required']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('senha') }}
                        <input class="form-control" min="6" placeholder="Nova Senha" name="senha" type="password", required>
                    </div>

                    <div class="form-group">
                    {{ Form::label('Confirme a Senha') }}
                        <input class="form-control" min="6" placeholder="Confirme a Senha" name="senhac" type="password", required>
                    </div>

                    <div class="form-group">
                        <label> Grupo </label>
                        {{ Form::text('nomegrupo', null, ['class' => 'form-control', 'id' => 'nomegrupo', 'disabled ']) }}
                        {{ Form::hidden('id_grupo', null, ['id' => 'id_grupo']) }}

                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                    {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
<!-- Cadastro de Usuario no Grupo - Fim -->


<!-- Regras Geral - Inicio -->
<div id="ModalRegrasGeral" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4> Regas Geral</h4>
            </div>
            <div class="modal-body">

                {{ Form::open(array('url' => 'regras')) }}

                <div class="input-group">
                    {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                    {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'dominio', 'required' => 'required']) }}
                    {{ Form::label('*', '.*', array('class' => 'input-group-addon')) }}
                    {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'), 'L', array('class' => 'form-control')) }}

                    {{ Form::hidden('id_grupo', '0') }}
                    {{ Form::hidden('id_usuario', '0') }}
                </div>
            </div>

            <div class="modal-footer">
                {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- Regras Geral - Fim -->


<!-- Remove Grupo -->
<div id="ModalRemoveGrupo" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4> Tem certeza de que deseja remover o grupo ? </h4>
            </div>
            <div class="modal-body">
                <strong id="grupo" class="fa fa-users"></strong>
                {{ Form::open(['route' => ['grupo.destroy','id'], 'id' => 'modal_delete_grupo', 'method' => 'DELETE']) }}
            </div>
            <small class="text-danger">  *Para excluir um grupo é necessário que ele esteja vazio.</small>
             <div class="modal-footer">
                {{ Form::submit('Sim', ['class' => 'btn btn-danger']) }}
                {{ Form::button('Não', ['class' => 'btn btn-info', 'data-dismiss' => 'modal']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- Remove Grupo - Fim-->





<!-- Lista Regras Geral -->
<div id="ModalListaRegras" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4>Lista de Regras Geral</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    @if(empty($Regras))
                        <div class="alert alert-danger"> Você não tem nenhuma regra cadastrada, faça primeiro o cadastro da regra. </div>
                    @else
                        @foreach($Regras as $r)
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
                        @endforeach
                            @endif
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
            </div>
        </div>
    </div>
</div>
<!-- Lista Regras Geral - Fim -->


<!-- Regras para o Grupo - Inicio -->
<div id="ModalRegrasGrupo" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4>Regras para o Grupo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'regras')) }}
                <div class="input-group">
                    {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                    {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'dominio', 'required' => 'required']) }}
                    {{ Form::label('*', '.*', array('class' => 'input-group-addon')) }}
                    {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'), 'L', array('class' => 'form-control')) }}

                    {{ Form::hidden('id_usuario', '0') }}
                </div>
                <hr>

                <div class="form-group">
                    <h4> Grupo </h4>
                    @if(empty($Grupos))
                        <div class="alert alert-danger"> Você não tem nenhum grupo cadastrado, faça primeiro o cadastro do grupo. </div>
                    @else
                        <select name="id_grupo" required="required" class="form-control">
                            <option> Selecionar...</option>
                            @foreach($Grupos as $g)
                                <option value="{{$g->id_grupo}}"> {{ $g->nome }}</option>
                            @endforeach
                        </select>
                     @endif
                </div>

            </div>
            <div class="modal-footer">
                {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- Regras para o Grupo - Fim -->



<!-- Lista Regras do Grupo - Inicio -->
<div id="ModalListaRegrasGrupo" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4> Erro - Lista de Regras do Grupo</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    @if(empty($Regras))
                        <div class="alert alert-danger"> Você não tem nenhuma regra cadastrada, faça primeiro o cadastro da regra. </div>
                    @else
                        @foreach($Regras as $r)
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

                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
            </div>
        </div>
    </div>
</div>
<!-- Lista Regras do Grupo - Fim -->



<!-- Remove Usuario -->
<div id="ModalRemoveUsuario" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4> Tem certeza de que deseja remover o Usuario ? </h4>
            </div>
                {{ Form::open(['route' => ['usuario.destroy','id'], 'id' => 'modal_delete_usuario', 'method' => 'DELETE']) }}
            <div class="modal-footer">
                {{ Form::submit('Sim', ['class' => 'btn btn-danger']) }}
                {{ Form::button('Não', ['class' => 'btn btn-info', 'data-dismiss' => 'modal']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- Remove Usuario - Fim-->