@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{route('admin.prototypes.create')}}" class="btn btn-primary">Создать</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($Prototypes as $Prototype)
                <tr>
                    <th>#{{$Prototype->id}}</th>
                    <td>{{$Prototype->title}}</td>
                    <td>{{$Prototype->answers()->count()}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop