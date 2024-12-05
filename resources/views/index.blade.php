@section('sidebar')
@include('layouts._partials.sidebar_admin')

@endsection

@extends('layouts.user_view', ['headers'=>[]])

@section('title', 'Index')

@section('content')
    <h1>Inicio</h1>
@endsection