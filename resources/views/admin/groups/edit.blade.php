@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('admin.groups.update', $Group)}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="">Название</label>
                    <input class="form-control" type="text" name="title" value="{{$Group->title}}">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
            </form>
            <hr>
            <h4>Студенты группы</h4>
            @if($Users = $Group->user)
                <table class="table">
                    @foreach($Users as $User)
                        <tr>
                            <th>{{$User->id}}</th>
                            <td>{{$User->getName()}}</td>
                            <td>{{$User->tests()->count()}}</td>
                            <td>
                                <a href="{{route('admin.users.edit', $User)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a class="btn btn-danger btn-xs" href="{{route('admin.users.removeGroup', $User)}}"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="text-center text-muted">В группе нет студентов</div>
            @endif
        </div>
    </div>
@stop