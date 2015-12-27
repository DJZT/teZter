@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('admin.prototypes.update', $Prototype)}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="">Название теста</label>
                    <input class="form-control" type="text" name="prototype[title]" value="{{$Prototype->title}}" required>
                </div>
                <div class="form-group">
                    <label for="">Длительность теста</label>
                    <input class="form-control" type="number" name="prototype[title]" value="{{$Prototype->time}}">
                    <span class="help-block">Укажите длительность в минутах</span>
                </div>
                <div class="form-group">
                    <label for="">Количество вопросов из общего числа</label>
                    <input class="form-control" type="number" name="prototype[title]" value="{{$Prototype->title}}">
                    <span class="help-block">Установите ноль "0" что бы использовались все вопросы</span>
                </div>
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <h3>Вопросы</h3>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="{{route('admin.questions.create', $Prototype)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> вопрос</a>
                </div>
            </div>
            @if($Prototype->questions()->count())
                <table class="table">
                    @foreach($Prototype->questions as $Question)
                        <tr>
                            <td>{{$Question->text}}</td>
                            <td></td>
                            <td class="text-info">
                                {{$Question->answers()->count()}}
                                @if($Question->image)
                                    <span class="glyphicon glyphicon-picture"></span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{route('admin.questions.edit', [$Prototype, $Question])}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{{route('admin.questions.delete',$Question)}}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <span class="text-muted">Нет вопросов.</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop