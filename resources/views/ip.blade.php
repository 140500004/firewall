@extends('layouts.dashboard')
@section('page_heading','IP´s')
@section('section')

@section ('panel2_panel_title', 'Lista de IP´s')
@section ('panel2_panel_body')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    <a class="btn btn-success" href="{{ route('ip.create') }}"> Novo IP</a>
    <br><br>

    @if(empty($ips[0]->ip))
        <div class="alert alert-danger"> Você não tem nenhum IP cadastrado. </div>
    @else

        <div class="text-center">
            <table class="table table-responsive table-hover table-bordered text-center">
                <thead>
                    <tr class="active">
                        <th class="text-center"> IP</th>
                        <th class="text-center"> Tipo</th>
                        <th class="text-center"> Descriçao</th>
                        <th class="text-center"> Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $ips as $ip )
                        <tr class=".table-hover">
                            <td>{{ $ip->ip }}</td>
                            <td>{{ $ip->tipo }}</td>
                            <td>{{ $ip->descricao }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('ip.edit',$ip->id_ip) }}">Editar</a>
                                {{ Form::open(['method' => 'DELETE','route' => ['ip.destroy', $ip->id_ip],'style'=>'display:inline', 'class' => 'conf-drop']) }}
                                {{ Form::submit('Deletar', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-offset-5">
            {{ $ips->render() }}
        </div>
    @endif

@endsection
@include('widgets.panel', array('class'=>'primary', 'header'=>true, 'as'=>'panel2'))

@stop
