@extends('layouts.app')

@section('content')
<div class="feed-wrapper text-center">
    @include('_items', [
        'items' => $items,
    ])
</div>
@endsection