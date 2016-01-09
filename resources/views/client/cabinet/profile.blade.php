@extends('client.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$User->getName()}}</h4>
                    @if($User->group_id)
                        {{$User->group->title}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <?php
        $Assigners = $User->assigners()->where('date_end', '>=', \Carbon\Carbon::now())->where('test_id', 0)->get();

    ?>
    @if($Assigners->count())
        <div class="alert alert-info">
            У вас есть назначенные тесты для прохождения
            <ul>
                @foreach($Assigners as $Assigner)
                    <li>Тема {{$Assigner->prototype->title}} <a href="{{route('client.assigner.show', $Assigner)}}">Пройти</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Профиль</a></li>
            <li role="presentation"><a href="#my_tests" aria-controls="my_tests" role="tab" data-toggle="tab">Тесты</a></li>
            @if($Group = $User->group)
                <li role="presentation"><a href="#my_group" aria-controls="my_group" role="tab" data-toggle="tab">Группа <span class="badge">{{$Group->users()->count()}}</span></a></li>
            @endif
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">

            </div>
            <div role="tabpanel" class="tab-pane" id="my_tests">
                @if($Tests = $User->tests)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Дата прохождения</th>
                            <th>Оценка</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($Tests as $Test)
                                <tr>
                                    <td>{{$Test->prototype->tittle}}</td>
                                    <td>
                                        @if($Test->data_ended && $Test->data_ended < \Carbon\Carbon::now())
                                            <span class="label label-success"></span>
                                        @elseif($Test->data_end)

                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if($Group = $User->group)
                <div role="tabpanel" class="tab-pane" id="my_group">
                    <table class="table">
                        <tbody>
                        @foreach($Group->users as $UserGroup)
                            <tr class="@if($UserGroup->id == $User->id) {{"info"}} @endif">
                                <td>{{$UserGroup->getName()}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@stop