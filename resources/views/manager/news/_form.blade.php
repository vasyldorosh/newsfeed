@if (count($errors) > 0)
<div class="alert alert-danger">
    There were some problems adding the category.<br />
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif    

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', isset($model->title) ? $model->title : null , ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', isset($model->slug) ? $model->slug : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', [1=>1, 2=>2], isset($model->category_id) ? $model->category_id : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', isset($model->content) ? $model->content : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
