@extends('layouts.manager')

@section('content')

<h3>Создание Zen канала</h3>

{!! Form::open(['method'=>'POST', 'route' => 'manager.zen_channel.store']) !!}

@include('manager.zen_channel._form')

{!! Form::close() !!}

@endsection