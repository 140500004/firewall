@extends('layouts.dashboard')
@section('page_heading','Gerenciamento ')
@section('section')
@include('modal')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button type="button" class="btn btn-default disabled fa fa-sitemap"> <strong>  {{ shell_exec("domainname -a | grep . | cut -d ' ' -f2 | cut -c9- | tr [a-z] [A-Z]") }} </strong> </button>
                <div class="pull-right">
                    <button type="button" class="btn btn-default fa fa-users" data-toggle="modal" data-target="#ModalNovoGrupo"> Novo Grupo</button>
                    <a class="btn btn-default btn btn-default fa fa-file-text" data-tt="tooltip" title="Regras do Grupo" href="{{ route('regras.index') }}"> Regras Geral</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="panel-group" id="accordion">

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

                    @if ($message = Session::get('warning'))
                        <div class="alert alert-warning alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('info'))
                        <div class="alert alert-info alert-block">
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


                    @if(empty($Grupos))
                        <div class="alert alert-danger"> Você não tem nenhum grupo e usuario cadastrado. </div>
                    @else
                        @foreach($Grupos as $g)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{$g->id_grupo}}">
                                        <button type="button" class="btn btn-default disabled fa fa-users" > <strong> {{$g->nome}} </strong></button>
                                    </a>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-default fa fa-user-plus" data-tt="tooltip" title="Novo Usuario" onclick="grupousuario( '{{$g->id_grupo}}', '{{$g->nome}}')" data-toggle="modal" data-target="#ModalNovoUsuario"> </button> <!-- Novo Usuario -->
                                        <a class="btn btn-default fa fa-file-excel-o" data-tt="tooltip" title="Regras do Grupo {{ $g->nome }}" href="{{ url('regras',$g->id_grupo) }}"> </a>
                                        <button type="button" class="btn btn-default fa fa-trash" data-tt="tooltip" title="Remove Grupo {{ $g->nome }}" onclick="removerGrupo( '{{$g->id_grupo}}', '{{$g->nome}}')" data-toggle="modal" data-target="#ModalRemoveGrupo"> </button> <!-- Remover o Grupo-->
                                    </div>
                                </h4>
                            </div>

                            <div id="{{ $g->id_grupo }}" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <?php $i = 0; ?>

                                    @foreach( $Usuarios as $u )
                                        @if( $u->id_grupo == $g ->id_grupo and $u->status == 'A')
                                            <a class="btn btn-primary fa fa-user" href="{{ url('usuario',$u ->id_usuario) }}"> {{ $u->nome }}</a>
                                            <?php $i ++; ?>
                                        @endif
                                        @if( $u->id_grupo == $g->id_grupo and $u->status == 'I')
                                            <a class="btn btn-default fa fa-user" href="{{ url('usuario',$u ->id_usuario) }}"> {{ $u->nome }}</a>
                                            <?php $i ++; ?>
                                        @endif

                                    @endforeach

                                    @if( $i == 0 )
                                        <div class="alert alert-danger"> Nenhum usuario no grupo. </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>

@stop