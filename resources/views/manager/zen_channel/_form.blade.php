@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif    

<div class="form-group">
    {!! Form::label('url', 'Урл') !!}
    {!! Form::text('url', isset($model->url) ? $model->url : null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::button('Отправить', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
