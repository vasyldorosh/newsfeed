@extends('layouts.manager')

@section('content')
<h3>Zen каналы</h3>

<a href="{{route('manager.zen_channel.create')}}" class="btn btn-primary btn-sm">создать</a>
<br/>
<br/>

@if ($collection->count())
<div class="table-responsive-xl">
    <table class="table table-striped table-bordered">
        <thead class="">
            <tr>
                <th>#</th>
                <th>Урл</th>
                <th></th>
            </tr>
        </thead
        <tbody>
            @foreach ($collection as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td><a href="{{$item['url']}}" target="_blank">{{$item['url']}}</a></td>
                <td style="min-width: 200px;">
                    <form action="{{ route('manager.zen_channel.destroy', ['id'=>$item['id']]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="{{ route('manager.zen_channel.edit', ['id'=>$item['id']]) }}" class="btn btn-success btn-sm">Редактировать</a>
                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                    </form>                            
                </td>
            </tr>
            @endforeach    
        </tbody>
    </table>
</div>

{{ $collection->links() }}

@else
<p>пока нет каналов</p>
@endif
@endsection