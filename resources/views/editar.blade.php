@extends('layouts.dashboard')
@section('page_heading','Editar IP')
@section('section')

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            @foreach($errors->all() as $r)
                <strong>{{ $r ."</br>"}}</strong>
            @endforeach
        </div>
    @endif

    {{ Form::model('ip', ['method' => 'PATCH','route' => ['ip.update', $ips->id_ip]]) }}

        <div class="form-horizontal col-md-4 control-label col-md-offset-4">
            <div class="form-group ">
                {{ Form::label('Endereço de IP') }}
                {{ Form::text('ip', $ips->ip, ['class' => 'form-control', 'placeholder' => '192.168.0.0', 'required' => 'required' ]) }}
            </div>

            <div class="form-group">
                {{ Form::label('Descriçao') }}
                {{ Form::text('descricao', $ips->descricao, ['class' => 'form-control', 'placeholder' => 'Descriçao .......', 'required' => 'required']) }}
            </div>

            <div class="form-group">
                {{ Form::label('Tipo') }}
                {{ Form::select('tipo', array('B' => 'Bloqueado', 'L' => 'Liberado'),  $ips->tipo, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
                <a class="btn btn-danger" href="{{ route('ip.index') }}"> Fechar</a>
                {{ Form::close() }}
            </div>
        </div>

@stop