@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            Назначения
        </div>
        <div class="panel-body">

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Пользователь</th>
                    <th>Действие</th>
                    <th>Назначено</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($Assigners as $Assigner)
                <tr>
                    <th>#{{$Assigner->id}}</th>
                    <td>
                        @if($User = $Assigner->user)
                            <a href="{{route('admin.users.edit', $User)}}">{{$User->getName()}}</a>
                        @endif
                    </td>
                    <td>{{$Assigner->date_end}}</td>
                    <td>{{$Assigner->created_at}}</td>
                    <td>
                        <a href="{{route('admin.assigners.delete', $Assigner)}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="panel-body">
            {!! $Assigners->render() !!}
        </div>
    </div>
@stop