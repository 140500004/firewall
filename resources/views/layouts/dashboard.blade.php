@extends('layouts.plane')
@section('body')

 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}"> ProTector </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <em>
                    <strong>
                        Seja Bem-Vindo:  {{ Auth::user()->name }}
                    </strong>
                </em>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="perfil"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li {{ (Request::is('*activedirectory') ? 'class="active"' : '') }}>
                            <a href="{{ url ('activedirectory') }}"><i class="fa fa-sitemap fa-fw"></i> Gerenciamento</a>
                            <!-- /.nav-second-level -->
                        </li>

                        <li >
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Squid<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li {{ (Request::is('*ip') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('ip' ) }}"> IP´s</a>
                                </li>

                                <li {{ (Request::is('*relatorio') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('relatorio' ) }}"> Relatório </a>
                                </li>

                                <li {{ (Request::is('*ajustes') ? 'class="active"' : '') }}>
                                    <a href="{{ url ('ajustes') }}"> Ajustes</a>
                                </li>

                                <!-- <li { (Request::is('*logs') ? 'class="active"' : '') }}>
                                    <a href="{ url ('logs') }}"> Logs do Squid</a>
                                </li> -->

                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                 @include('webService')
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">
				@yield('section')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop
