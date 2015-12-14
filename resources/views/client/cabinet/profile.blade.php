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

    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Профиль</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Тесты</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Группа <span class="badge">{{$User->group->users()->count()}}</span></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">

            </div>
            <div role="tabpanel" class="tab-pane" id="profile">

            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <table class="table">
                    <tbody>
                    @foreach($User->group->users as $UserGroup)
                        <tr class="@if($UserGroup->id == $User->id) {{"info"}} @endif">
                            <td>{{$UserGroup->getName()}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop