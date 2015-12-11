@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Редактирование группы</div>
        <div class="panel-body">
            <form action="{{route('admin.groups.update')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input id="title" class="form-control" type="text" name="title" value="{{$Group->title}}" placeholder="Название">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </div>
            </form>
        </div>
    </div>
@stop