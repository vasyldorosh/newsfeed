@extends('layouts.manager')

@section('content')
<h3>Zen канал - просмотр</h3>

<div class="table-responsive-xl">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>#</td>
                <td>{{ $model['id'] }}</td>
            </tr>    
            <tr>
                <td>Урл</td>
                <td>{{ $model['url'] }}</td>
            </tr>    
        </tbody>
    </table>
</div>
@endsection