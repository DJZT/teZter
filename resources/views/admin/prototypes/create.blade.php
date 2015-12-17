@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('admin.prototypes.store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="">Название теста</label>
                    <input class="form-control" type="text" name="prototype[title]" value="{{old('prototype.title')}}" placeholder="Название" required>
                </div>
                <div class="form-group">
                    <label for="">Длительность теста</label>
                    <input class="form-control" type="number" name="prototype[time]" value="{{old('prototype.time')}}}">
                    <span class="help-block">Укажите длительность в минутах</span>
                </div>
                <div class="form-group">
                    <label for="">Количество вопросов из общего числа</label>
                    <input class="form-control" type="number" name="prototype[count_questions]" value="{{old('prototype.count_questions')}}">
                    <span class="help-block">Установите ноль "0" что бы использовались все вопросы</span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Создать">
                </div>
            </form>
        </div>
    </div>
@stop