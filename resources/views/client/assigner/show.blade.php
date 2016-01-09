@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h4>Назначение <b>#{{$Assigner->id}}</b></h4>
            Уважаемый {{$Assigner->user->getName()}}, Вам назначен тест по теме <b>{{$Assigner->prototype->title}}</b>. Тест необходимо пройти до <b>{{$Assigner->date_end}}</b>.
            Тест содержит <b>{{$Assigner->prototype->count_questions}}</b> вопросов. Время на прохождение теста <b>{{$Assigner->prototype->time}}</b> минут.
            <div class="text-center">
                <a class="btn btn-info btn-lg" href="{{route('client.test.assigner.start', $Assigner)}}">Начать</a>
            </div>
        </div>
    </div>
@stop