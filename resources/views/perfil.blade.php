@extends('layouts.dashboard')
@section('page_heading','Perfil: ' . Auth::user()->name )
@section('section')

    @if ($message = Session::get('success'))

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-danger">Atenção</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger"><strong> É necessário fazer login com as novas informações.</strong></p>
                       <META HTTP-EQUIV=Refresh CONTENT="5; URL=/auth/logout">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }} <p></strong>

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

    {{ Form::model('perfil', ['method' => 'PUT','route' => ['activedirectory.update', Auth::user()->id]])}}
    <div class="form-horizontal col-md-6 control-label col-md-offset-3">

        <div class="form-group ">
            {{ Form::label('Nome') }}
            {{ Form::text('nome', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => 'required' ]) }}
        </div>

        <div class="form-group ">
            {{ Form::label('E-mail') }}
            {{ Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'email@email.com', 'required' => 'required' ]) }}
        </div>

        <div class="form-group">
            {{ Form::label('Senha Atual') }}
            {{ Form::password('senhaa', ['class' => 'form-control', 'placeholder' => 'Senha Atual']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Nova senha') }}
            {{ Form::password('senha', ['class' => 'form-control', 'placeholder' => 'Nova Senha']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Confirme a Senha') }}
            {{ Form::password('senhac', ['class' => 'form-control', 'placeholder' => 'Nova Senha']) }}
        </div>


        <div class="form-group">
            {{ Form::submit('Salvar', ['class' => 'btn btn-success']) }}
            <a class="btn btn-danger" href="{{ url('home') }}"> Fechar</a>


            {{ Form::close() }}
        </div>

    </div>

@stop
