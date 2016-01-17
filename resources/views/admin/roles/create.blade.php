@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Создание роли</div>
        <div class="panel-body">
            <form action="{{route('admin.roles.store')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="">Название</label>
                    <input class="form-control" type="text" name="title" value="{{old('title')}}" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="">По умолчанию</label>
                    <input type="checkbox" name="default" value="1">
                </div>
                <div class="form-group">
                    <label for="">Администратор</label>
                    <input type="checkbox" name="admin" value="1">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Создать">
                </div>
            </form>
        </div>
    </div>
@stop