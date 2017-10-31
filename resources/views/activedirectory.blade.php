@extends('layouts.dashboard')
@section('page_heading','Active Directory')
@section('section')
@include('modal')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <button type="button" class="btn btn-default disabled fa fa-sitemap"> <strong>  SERVER.COM </strong> </button>
                <div class="pull-right">
                    <button type="button" class="btn btn-default fa fa-users" data-toggle="modal" data-target="#ModalNovoGrupo"> Novo Grupo</button>
                    <button type="button" class="btn btn-default fa fa-user-plus" data-toggle="modal" data-target="#ModalNovoUsuario"> Novo Usuário</button>
                    <button type="button" class="btn btn-default fa fa-list-alt" data-toggle="modal" data-target="#ModalRegrasUsuario"> Regras Para Usuário</button>
                    <button type="button" class="btn btn-default fa fa-list-alt" data-toggle="modal" data-target="#ModalRegrasGrupo"> Regras Para Grupo</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalRegrasGeral"> Regras Geral</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalListaRegras"> Lista Regra Geral</button>
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
                                        <button type="button" class="btn btn-default fa fa-trash" onclick="removerGrupo( '{{$g->id_grupo}}', '{{$g->nome}}')" data-toggle="modal" data-target="#ModalRemoveGrupo"> Deletar</button>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalListaRegrasGrupo"> Listar Regras do grupo</button>
                                    </div>
                                </h4>
                            </div>

                            <div id="{{ $g->id_grupo }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @foreach( $Usuarios as $u )
                                        @if( $u->id_grupo == $g ->id_grupo and $u->status == 'A')
                                            <button type="button" class="btn btn-primary fa fa-user"
                                                    onclick="listaUsuario( '{{$u->id_usuario}}', '{{$u->nome}}', '{{$u->login}}', '{{$u->senha}}', '{{$u->id_grupo}}', '{{$u->status}}')"
                                                    data-toggle="modal" data-target="#ModalUsuario"> {{ $u->nome }} </button>
                                        @endif
                                        @if( $u->id_grupo == $g->id_grupo and $u->status == 'I')
                                             <button type="button" class="btn btn-default fa fa-user"
                                                     onclick="listaUsuario( '{{$u->id_usuario}}', '{{$u->nome}}', '{{$u->login}}', '{{$u->senha}}', '{{$u->id_grupo}}', '{{$u->status}}')"
                                                     data-toggle="modal" data-target="#ModalUsuario"> {{ $u->nome }} </button>
                                        @endif

                                            @foreach( $RegrasUG as $UG )
                                                @if( $UG->id_usuario == $u->id_usuario )



                                                @endif
                                            @endforeach

                                    @endforeach
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