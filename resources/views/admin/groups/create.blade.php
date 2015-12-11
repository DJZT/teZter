@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading h4">Создание группы</div>
        <div class="panel-body">
            <form action="{{route('admin.groups.store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" class="form-control" type="text" name="title" placeholder="Название группы" required>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Создать">
                </div>
            </form>
        </div>
    </div>
@stop