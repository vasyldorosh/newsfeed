@extends('layouts.app')

@section('content')
<div class="article-side">
  
    <div>

        <div class="page-article">
            <h1>{{ $model['title'] }}</h1>
            
            {!! $model['content'] !!}
            
            <div class="page-article__end"></div>
            
            <p class="page-artilce__article-source" style="color: #999">
                Источник: <a href="{{ $model['resource_url'] }}" rel="nofollow" target="_blank">{{ $model['resource'] }}</a>
            </p>
        </div>    
    </div>
</div>
@endsection
