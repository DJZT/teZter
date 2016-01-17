@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3>Тесты пользователей</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Тема</th>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Время выполнения</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($Tests as $Test)
                <tr>
                    <th>#{{$Test->id}}</th>
                    <td>{{$Test->prototype->title or ""}}</td>
                    <td>
                        {{$Test->user->getName()}}
                    </td>
                    <td>{{$Test->date_completed}}</td>
                    <td>{{$Test->result()}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="{{route('admin.tests.show', $Test)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop