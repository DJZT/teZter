@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div><a href="{{route('client.cabinet')}}" class="btn btn-link">Профиль</a></div>
            <h4>Результаты теста <b>#{{$Test->id}}</b></h4>
            <div class="h3">Ваш бал <span class="label label-info">{{round($Test->result(), 2)}}</span></div>
        </div>
    </div>
@stop