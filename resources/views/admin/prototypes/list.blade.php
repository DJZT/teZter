@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{route('admin.prototypes.create')}}" class="btn btn-primary">Создать</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Название</th>
                <th>Вопросов</th>
                <th>Время</th>
                <th>Тестов</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($Prototypes as $Prototype)
                <tr>
                    <th>#{{$Prototype->id}}</th>
                    <td>{{$Prototype->title}}</td>
                    <td {{$Prototype->count_questions > $Prototype->questions()->count() ? "class=text-danger" : ""}}>{{$Prototype->count_questions}}/{{$Prototype->questions()->count()}}</td>
                    <td>{{$Prototype->time}} минут</td>
                    <td>{{$Prototype->tests()->count()}}</td>
                    <td class="text-right">
                        <a class="btn btn-warning btn-xs" href="{{route('admin.prototypes.edit', $Prototype)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="{{route('admin.prototypes.destroy', $Prototype)}}" class="btn btn-danger btn-xs" onclick="return confirm('Вы действительно хотите удалить прототип теста №{{$Prototype->id}}')"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop