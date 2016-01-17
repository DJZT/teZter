@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Редактирование роли</div>
        <div class="panel-body">
            <form action="{{route('admin.roles.update', $Role)}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="">Название</label>
                    <input class="form-control" type="text" name="title" value="{{$Role->title}}" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="">По умолчанию</label>
                    <input type="checkbox" name="default" value="1" @if($Role->default) {{"checked"}} @endif>
                </div>
                <div class="form-group">
                    <label for="">Администратор</label>
                    <input type="checkbox" name="admin" value="1" @if($Role->admin) {{"checked"}} @endif>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
            </form>
        </div>
    </div>
@stop