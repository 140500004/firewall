@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')
                @section ('pane2_panel_title', 'Status do servidor')
                @section ('pane2_panel_body')


                        <div class="list-group ">
                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw" ></i> SAMBA STATUS
                                <span class="pull-right text-muted small"><em> {{shell_exec("systemctl status samba-ad-dc | grep Active | cut -d ' ' -f5") }} </em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> SQUID STATUS
                                <span class="pull-right text-muted small"><em> {{shell_exec("systemctl status squid3 | grep Active | cut -d ' ' -f5") }} </em>
                                </span>
                            </a>


                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> CPU
                                <span class="pull-right text-muted small"><em> {{shell_exec("lscpu | grep 'Model name:' | tr -s ' ' | cut -c13-") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Memória
                                <span class="pull-right text-muted small"><em> {{ shell_exec("free -m | grep Mem: | tr -s ' ' | cut -d ' ' -f4  | tr -s ' '") }} / {{shell_exec("free -mh | grep Mem: | tr -s ' ' | cut -d ' ' -f2") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> SWAP
                                <span class="pull-right text-muted small"><em> {{ shell_exec("free -m | grep Swap: | tr -s ' ' | cut -d ' ' -f4  | tr -s ' '") }} / {{shell_exec("free -mh | grep Swap: | tr -s ' ' | cut -d ' ' -f2") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Disco Rigido
                                <span class="pull-right text-muted small"><em> {{ shell_exec("") }} {{ shell_exec(" df -Th | grep /dev/sd | tr -s ' ' | cut -d ' ' -f5") }} / {{ shell_exec(" df -Th | grep /dev/sd | tr -s ' ' | cut -d ' ' -f3") }} - {{ shell_exec("df -Th | grep /dev/sd | tr -s ' ' | cut -d ' ' -f2 | tr [a-x] [A-Z]") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> S.O
                                <span class="pull-right text-muted small"><em> {{ shell_exec("cat /etc/*-release | grep PRETTY_NAME | cut -c14- | tr -s '\"' ' '") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Kenel
                                <span class="pull-right text-muted small"><em> {{ shell_exec("uname -r | tr [a-z] [A-Z]") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Hostname
                                <span class="pull-right text-muted small"><em> {{ shell_exec("hostname | tr [a-z] [A-Z]") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> Dominio
                                <span class="pull-right text-muted small"><em> {{ shell_exec("domainname -a | grep . | cut -d ' ' -f2 | cut -c9- | tr [a-z] [A-Z] ") }}</em>
                                </span>
                            </a>

                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> ETH0 - WAN
                                <span class="pull-right text-muted small"><em> {{ shell_exec("ifconfig eth0 | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*'") }}</em>
                                </span>
                            </a>


                            <a class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> ETH1 - LAN
                                <span class="pull-right text-muted small"><em> {{ shell_exec("ifconfig eth1 | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*'") }}</em>
                                </span>
                            </a>

                        </div>
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
@stop
