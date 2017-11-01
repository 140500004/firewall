@extends('layouts.dashboard')
@section('page_heading','Log`s do Squid')
@section('section')

<?php
    $er = shell_exec("cat /var/log/squid3/access.log");
    echo "$er </br>" ;
?>

@stop