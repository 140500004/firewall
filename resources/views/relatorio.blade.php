@extends('layouts.dashboard')
@section('page_heading','Relatórios')
@section('section')

    <div class="col-md-4">
        @section ('panel1_panel_title', 'SARG')
        @section ('panel1_panel_body')
            Usando o Sarg para monitorar o acesso é um interpretador de logs para o Squid.
        @endsection
        @section ('panel1_panel_footer', '<a class="btn btn-warning" target="_blank" href="http://192.168.2.1:8080/sarg/">Ver</a>')
        @include('widgets.panel', array('class'=>'warning', 'header'=>true, 'footer'=>true, 'as'=>'panel1'))
    </div>
    <div class="col-md-4">
        @section ('panel2_panel_title', 'LightSquid')
        @section ('panel2_panel_body')
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        @endsection
        @section ('panel2_panel_footer', '<a class="btn btn-warning" href="#">Ver</a>')
        @include('widgets.panel', array('class'=>'warning', 'header'=>true, 'footer'=>true, 'as'=>'panel2'))
    </div>

    <div class="col-md-4">
        @section ('panel3_panel_title', 'Webalizer ')
        @section ('panel3_panel_body')
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
        @endsection
        @section ('panel3_panel_footer',  '<a class="btn btn-warning" href="#">Ver</a>')
        @include('widgets.panel', array('class'=>'warning', 'header'=>true, 'footer'=>true, 'as'=>'panel3'))
    </div>


@stop