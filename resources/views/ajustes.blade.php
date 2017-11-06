@extends('layouts.dashboard')
@section('page_heading','Ajustes')
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


    <!-- Busca a informação no banco-->
    <?php
        $tipo =DB::select('select tipo from conf');
    ?>

    {{ Form::open(array('url' => 'activedirectory')) }}
    <div class="form-horizontal col-md-5 control-label col-md-offset-0">
    {{ Form::label('Regras Geral') }}
    <div class="input-group">
        {{ Form::label('http_access', 'http_access', array('class' => 'input-group-addon')) }}
        {{ Form::select('tipo', array('deny' => 'deny - Bloqueado', 'allow' => 'allow - Liberado'), $tipo[0]->tipo, array('class' => 'form-control')) }}
        {{ Form::label('all', 'all', array('class' => 'input-group-addon')) }}
        {{ Form::label('', '', array('class' => 'input-group-btn')) }}

        {{ Form::submit('Salvar', ['class' => 'btn btn-success form-control']) }}
        {{ Form::close() }}
        </div>
    </div>

@stop