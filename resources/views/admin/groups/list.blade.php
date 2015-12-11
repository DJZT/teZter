@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body"><a href="{{route('admin.groups.create')}}" class="btn btn-primary">Создать</a></div>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Название</th>
                <th>Пользователей</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($Groups as $Group)
                <tr>
                    <th>#{{$Group->id}}</th>
                    <td>{{$Group->title}}</td>
                    <td>
                        <a href="{{route('admin.users.list',['filter[group_id]' => $Group->id])}}">{{$Group->users->count()}}</a>
                    </td>
                    <td class="text-right">
                        <a href="{{route('admin.groups.edit', $Group)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="{{route('admin.groups.delete', $Group)}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop