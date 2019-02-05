@extends('layouts.manager')

@section('content')
<h3>News List</h3>

<a href="{{route('manager.news.create')}}" class="btn btn-primary">Add News</a>

@if ($collection->count())
<div class="table-responsive-xl">
    <table class="table table-striped table-bordered">
        <thead class="">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Content</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
            </tr>
        </thead
        <tbody>
            @foreach ($collection as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['title']}}</td>
                <td>{{$item['slug']}}</td>
                <td>{{$item['content']}}</td>
                <td>{{$item['created_at']}}</td>
                <td>{{$item['updated_at']}}</td>
                <td style="min-width: 200px;">
                    <form action="{{ route('manager.news.destroy', ['id'=>$item['id']]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="{{ route('manager.news.show', ['id'=>$item['id']]) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('manager.news.edit', ['id'=>$item['id']]) }}" class="btn btn-success btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>                            
                </td>
            </tr>
            @endforeach    
        </tbody>
    </table>
</div>

{{ $collection->links() }}

@else
<p>Empty news list</p>
@endif
@endsection