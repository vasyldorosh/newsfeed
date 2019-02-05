@extends('layouts.manager')

@section('content')
<h3>News View</h3>

<div class="table-responsive-xl">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>#</td>
                <td>{{ $model['id'] }}</td>
            </tr>    
            <tr>
                <td>Title</td>
                <td>{{ $model['title'] }}</td>
            </tr>    
            <tr>
                <td>Slug</td>
                <td>{{ $model['slug'] }}</td>
            </tr>    
            <tr>
                <td>Content</td>
                <td>{{ $model['content'] }}</td>
            </tr>    
            <tr>
                <td>Created at</td>
                <td>{{ $model['created_at'] }}</td>
            </tr>    
            <tr>
                <td>Updated at</td>
                <td>{{ $model['updated_at'] }}</td>
            </tr>    
        </tbody>
    </table>
</div>
@endsection