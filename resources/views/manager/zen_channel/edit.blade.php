@extends('layouts.manager')

@section('content')

<h3>Редактирование Zen канала</h3>

{!! Form::model($model, ['route' => ['manager.zen_channel.update', $model->id], 'method' => 'PUT']) !!}

@include('manager.zen_channel._form', [
'model' => $model
])

{!! Form::close() !!}

@endsection