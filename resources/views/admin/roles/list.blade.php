@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Создать</a>
        </div>
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
                @foreach($Roles as $Role)
                    <tr>
                        <th>#{{$Role->id}}</th>
                        <td>{{$Role->title}}</td>
                        <td>{{$Role->users()->count()}}</td>
                        <td class="text-right">
                            <a href="{{route('admin.roles.edit', $Role)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="{{route('admin.roles.delete', $Role)}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop