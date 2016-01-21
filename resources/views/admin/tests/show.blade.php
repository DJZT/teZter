@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            Результаты теста <b>#{{$Test->id}}</b> {{$Test->user->getName()}}
        </div>
        <div class="panel-body">
            <p class="h4"><b>Тема:</b> {{$Test->prototype->title}} <a href="{{route('admin.prototypes.edit', $Test->prototype)}}"><span class="glyphicon glyphicon-pencil"></span></a></p>
        </div>
        <table class="table table-bordered">
            <tr>
                <td colspan="3">
                    Всего вопросов: <b>{{$Test->questions()->count()}}</b>
                </td>
                <td>
                    {{--Среднее время на ответ: <b>{{$Test->created_at->diffInMinutes($Test->date_completed)/$Test->questions()->count() * 60}} сек</b>--}}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                   Длительность теста: <b>{{$Test->prototype->time}} мин</b>
                </td>
                <td rowspan="4" class="h2 text-center" style="vertical-align: middle">
                    <span class="label label-info">
                        {{$Test->result()}}
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Начало теста: <b>{{$Test->created_at}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                   Время прохождения: <b>{{$Test->created_at->diffInMinutes($Test->date_completed)}} мин</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Среднее время на ответ: <b>{{$Test->created_at->diffInMinutes($Test->date_completed)/$Test->questions()->count() * 60}} сек</b>
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th colspan="3">Вопрос</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle;">Балл</th>
            </tr>
            <tr>
                <th class="hidden-xs">#ID</th>
                <th colspan="2">Ответ</th>
            </tr>
            @foreach($Test->questions as $Question)
                <?php $ball = true;?>
                <tr class="active">
                    <th colspan="3">
                        {{$Question->text}}
                        <a href="{{route('admin.questions.edit', $Question)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                        @if($Question->image)
                            <a class="pull-right" href=""><span class="glyphicon glyphicon-picture"></span></a>
                        @endif</th>
                    @if($ball)
                        <?php $ball = false;?>
                        <td class="h2" rowspan="{{$Question->answers()->count() + 1}}" style="vertical-align: middle; text-align: center">
                            <span class="label label-info">
                                {{$Question->result()}}
                            </span>
                        </td>
                    @endif
                </tr>

                @foreach($Question->answers as $Answer)
                    <tr class="{{$Answer->right?"success":"danger"}}">
                        <th class="hidden-xs" width="50px">#{{$Answer->id}}</th>
                        <td>
                            {{$Answer->text}}
                            @if($Answer->image)
                                <a class="pull-right" href=""><span class="glyphicon glyphicon-picture"></span></a>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($Test->answers()->where('answer_id', $Answer->id)->right()->first())
                                <span class="label label-success">Правильно</span>
                            @elseif($Test->answers()->where('answer_id', $Answer->id)->first())
                                <span class="label label-danger">Не правильно</span>
                            @elseif($Answer->right && !$Test->answers()->where('answer_id', $Answer->id)->right()->first())
                                <span class="label label-warning">Не отмеченно</span>
                            @else

                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>
@stop
@section('css')
    <style>
        .invisible{
            visibility: hidden;
        }
        .visible-target:hover .invisible{
            visibility: visible;
        }

    </style>
@stop