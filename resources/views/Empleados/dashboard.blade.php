@section('sidebar')
@include('layouts._partials.sidebar_empleado')

@endsection

@extends('layouts.user_view', ['headers'=>[]])

@section('title', 'Index')


@section('content')
    <h1>Empleados</h1>
@endsection