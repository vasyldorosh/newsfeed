@extends('layouts.manager')

@section('content')

<h3>Update News</h3>

{!! Form::model($model, ['route' => ['manager.news.update', $model->id], 'method' => 'PUT']) !!}

@include('manager.news._form', [
'model' => $model
])

{!! Form::close() !!}

@endsection