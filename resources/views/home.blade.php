@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')
                @section ('pane2_panel_title', 'Status do servidor')
                @section ('pane2_panel_body')


                        <div class="list-group">
                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> SERVICE SAMBA STATUS
                                <span class="pull-right text-muted small"><em> OK</em>
                                </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> SERVICE SQUID STATUS
                                <span class="pull-right text-muted small"><em> OK</em>
                                </span>
                            </samp>


                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> CPU
                                <span class="pull-right text-muted small"><em> Intel(R) Core(TM) i7-5500U CPU @ 2.40GHz</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Memória
                                <span class="pull-right text-muted small"><em>512MB RAM</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Disco
                                <span class="pull-right text-muted small"><em> EXT4 14,3 GB - Samsung SSD 850 EVO 250GB</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> S.O
                                <span class="pull-right text-muted small"><em> Debian Jessie 8.9 - GNU/Linux</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Kenel
                                <span class="pull-right text-muted small"><em> 3.16.0-4-amd64</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Host
                                <span class="pull-right text-muted small"><em>GATEWAY</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> SWAP
                                <span class="pull-right text-muted small"><em> 671MB SWAP</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Dominio
                                <span class="pull-right text-muted small"><em> SERVER.COM</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> ETH0 - WAN
                                <span class="pull-right text-muted small"><em> 10.0.2.15/24</em>
                                    </span>
                            </samp>

                            <samp href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> ETH1 - LAN
                                <span class="pull-right text-muted small"><em> 192.168.2.1/24</em>
                                </span>
                            </samp>

                        </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
@stop
