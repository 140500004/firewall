@extends('layouts.dashboard')
@section('page_heading','Regras do Grupo: '. $RegrasG[0]->grupo )
@section('section')


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
            <li class="active"><a class="fa fa-file-text" data-toggle="tab" href="#listaRegras"> Regras</a></li>
        </ul>
    </nav>


    <div class="form-horizontal col-md-7 control-label col-md-offset-3 tab-content">

        <div id="listaRegras" class="tab-pane fade in active">

            {{ Form::open(array('url' => 'regras')) }}
            <div class="input-group">
                {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'dominio', 'required' => 'required']) }}
                {{ Form::label('*', '.*', array('class' => 'input-group-addon')) }}
                {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'), 'L', array('class' => 'form-control')) }}
                {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                {{ Form::hidden('id_usuario', '0') }}
                {{ Form::hidden('id_grupo', $RegrasG[0]->id_grupo) }}

                {{ Form::submit('Salvar', ['class' => 'btn btn-success form-control']) }}
                {{ Form::close() }}
            </div>

            <hr>

            @if(empty($RegrasG[0]->url))
                <div class="alert alert-danger"> Nenhuma regra cadastrada, faça primeiro o cadastro da regra. </div>
            @else
                {{ Form::label('http', 'http.', array('class' => 'col-xs-2')) }}
                {{ Form::label('Domínio', 'Domínio', array('class' => 'col-xs-4')) }}
                {{ Form::label('Tipo', 'Tipo', array('class' => 'col-xs-3')) }}
                {{ Form::label('Ação', 'Ação', array('class' => 'col-xs-3')) }}

                @foreach($RegrasG as $rg)
                    {{ Form::model('regras', ['method' => 'PUT','route' => ['regras.update', $rg->id_regras],'id' => 'conf-update'])}}
                    <div class="input-group">
                        {{ Form::label('www', 'www.', array('class' => 'input-group-addon')) }}
                        {{ Form::text( 'url', $rg->url, ['class' => 'form-control', 'placeholder' => 'url']) }}
                        {{ Form::label('', '.*', array('class' => 'input-group-addon')) }}
                        {{ Form::label('', '', array('class' => 'input-group-btn')) }}
                        {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'),  $rg->tipo, array('class' => 'form-control')) }}
                        {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                        {{ Form::label(' ', ' ', array('class' => 'input-group-btn')) }}
                        {{ Form::submit('Atualizar', ['class' => 'form-control btn-success']) }}
                        {{ Form::close() }}

                        {{ Form::label('', '', array('class' => 'input-group-btn')) }}

                        {{ Form::open(['method' => 'DELETE','route' => ['regras.destroy', $rg->id_regras],'style'=>'display:inline', 'id' => 'conf-drop']) }} <!-- 'id' => 'conf' Não funciona-->
                        {{ Form::submit('Deletar', ['class' => 'form-control btn-danger']) }}
                        {{ Form::close() }}
                    </div>
                    </p>
                @endforeach
            @endif
        </div>
    </div>

@stop