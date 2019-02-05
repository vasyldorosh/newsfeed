@extends('layouts.manager')

@section('content')

<h3>Create News</h3>

{!! Form::open(['method'=>'POST', 'route' => 'manager.news.store']) !!}

@include('manager.news._form')

{!! Form::close() !!}

@endsection