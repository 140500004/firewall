@extends('layouts.dashboard')
@section('page_heading','Usuario: '.$Usuario[0]->nome )
@section('section')

@include('modal')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @foreach($errors->all() as $r)
            <strong>{{ $r ."</br>"}}</strong>
        @endforeach
    </div>
@endif

    <nav class="navbar navbar">
        <ul class="nav nav-tabs">
            <li class="active"><a class="fa fa-user" data-toggle="tab" href="#perfil"> Perfil</a></li>
            <li><a class="fa fa-file-text" data-toggle="tab" href="#listaRegras"> Regras</a></li>
        </ul>
    </nav>

    <div class="form-horizontal col-md-7 control-label col-md-offset-3 tab-content">

        <div id="perfil" class="tab-pane fade in active">
            {{ Form::model('usuario', ['method' => 'PUT','route' => ['usuario.update', $Usuario[0]->id_usuario]])}}

                <input name="id_usuario" type="hidden" id="id" value={{$Usuario[0]->id_usuario}}>

                <div class="form-group">
                    {{ Form::label('nome do usuario') }}
                    {{ Form::text('nome', $Usuario[0]->nome, ['class' => 'form-control dis', 'placeholder' => 'Nome do Usuario', "readonly" => "readonly", 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('nome de login') }}
                    {{ Form::text('login', $Usuario[0]->login, ['class' => 'form-control', 'placeholder' => 'Nome do Login', "readonly" => "readonly", 'required' => 'required']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('nova senha') }}
                    {{ Form::password('senha', ['class' => 'form-control', 'placeholder' => 'Nova Senha']) }}
                </div>

                 <div class="form-group">
                    {{ Form::label('Confirme a Senha') }}
                     {{ Form::password('senhac', ['class' => 'form-control', 'placeholder' => 'Nova Senha']) }}
                 </div>

                <div class="form-group">
                    <label> Novo Grupo </label>
                    <select name="id_grupo" class="form-control">
                        <option value="{{$Usuario[0]->id_grupo}}"> {{$Usuario[0]->grupo}}</option>
                        @foreach($Grupos as $g)
                            @if( $g->id_grupo != $Usuario[0]->id_grupo )
                                <option value="{{ $g->id_grupo }}"> {{ $g->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('Inativar Usuario') }}
                    @if( $Usuario[0]->status == 'A')
                        <input name="status" type="checkbox" value="I">
                    @else
                        <input name="status" type="checkbox" checked value="I">
                    @endif
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-warning" onclick="removerUsuario()" data-toggle="modal" data-target="#ModalRemoveUsuario"> Deletar</button>
                    {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                    {{ Form::button('Fechar', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                    {{ Form::close() }}
                </div>

        </div>


        <div id="listaRegras" class="tab-pane fade">

            {{ Form::open(array('url' => 'regras')) }}
                <div class="input-group">
                    {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                    {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'dominio', 'required' => 'required']) }}
                    {{ Form::label('*', '.*', array('class' => 'input-group-addon')) }}
                    {{ Form::label('', '', array('class' => 'input-group-btn')) }}
                    {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'), 'L', array('class' => 'form-control')) }}
                    {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                    {{ Form::hidden('id_grupo', '0') }}
                    {{ Form::hidden('id_usuario', $Usuario[0]->id_usuario) }}

                    {{ Form::submit('Salvar', ['class' => 'btn btn-success form-control']) }}
                    {{ Form::close() }}
                </div>

            <hr>
            @if(empty($Regras))
                <div class="alert alert-danger"> Nenhuma regra cadastrada, faça primeiro o cadastro da regra. </div>
                    @else
                        {{ Form::label('http', 'http.', array('class' => 'col-xs-2')) }}
                        {{ Form::label('Domínio', 'Domínio', array('class' => 'col-xs-4')) }}
                        {{ Form::label('Tipo', 'Tipo', array('class' => 'col-xs-3')) }}
                        {{ Form::label('Ação', 'Ação', array('class' => 'col-xs-3')) }}

                        @foreach($Regras as $r)
                            {{ Form::model('regras', ['method' => 'PUT','route' => ['regras.update', $r->id_regras]])}}
                            <div class="input-group">
                                {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                                {{ Form::text( 'url', $r->url, ['class' => 'form-control', 'placeholder' => 'url']) }}
                                {{ Form::label('', '.*', array('class' => 'input-group-addon')) }}
                                {{ Form::label('', '', array('class' => 'input-group-btn')) }}
                                {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'),  $r->tipo, array('class' => 'form-control')) }}
                                {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                                {{ Form::label(' ', ' ', array('class' => 'input-group-btn')) }}
                                {{ Form::submit('Atualizar', ['class' => 'form-control btn-success']) }}
                                {{ Form::close() }}

                                {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                                {{ Form::open(['method' => 'DELETE','route' => ['regras.destroy', $r->id_regras],'style'=>'display:inline']) }}
                                {{ Form::submit('Deletar', ['class' => 'form-control btn-danger']) }}
                                {{ Form::close() }}
                            </div>
                            <p>
                        @endforeach
            @endif
        </div>
    </div>



@stop