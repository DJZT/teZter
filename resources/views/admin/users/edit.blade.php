@extends('admin.app')
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">Редактирование пользователя</div>
        <div class="panel-body">
            <form action="{{route('admin.users.update', $User)}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{$User->first_name}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{$User->last_name}}">
                </div>
                <div class="form-group">
                    <label for="second_name">Отчество</label>
                    <input id="second_name" type="text" class="form-control" name="second_name" value="{{$User->second_name}}">
                </div>
                <div class="form-group">
                    <label for="group_id">Группа</label>
                    @if($Groups->count())
                        <?php $create = false; ?>
                        <select name="group_id" id="group" class="form-control">
                            <option value="0"></option>
                            @foreach($Groups as $Group)
                                @if($Group->id == $User->group_id)
                                    <option value="{{$Group->id}}" selected>{{$Group->title}}</option>
                                @else
                                    <option value="{{$Group->id}}">{{$Group->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                Нет групп. <a href="{{route('admin.groups.create')}}" class="btn btn-info btn-xs">Создать</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role_id">Роль</label>
                    @if($Roles->count())
                        <?php $create = false; ?>
                        <select class="form-control" name="role_id" id="role" required>
                            @foreach($Roles as $Role)
                                @if($Role->id == $User->role_id)
                                    <option value="{{$Role->id}}" selected>{{$Role->title}}</option>
                                @else
                                    <option value="{{$Role->id}}">{{$Role->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                Нет ролей. <a href="{{route('admin.roles.create')}}" class="btn btn-info btn-xs">Создать</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-material-indigo">
                        <div class="panel-heading">
                            Тесты пользователя
                        </div>
                        @if($Tests = $User->tests)
                            <table class="table">
                                <tbody>
                                @foreach($Tests as $Test)
                                    <tr>
                                        {{--<td><a href="{{route('admin.test.show')}}">{{$Test->prototype->title}}</a></td>--}}
                                        <td>{{$Test->prototype->questions()->count()}}</td>
                                        <td>{{$Test->result()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="panel-body text-center"><span class="text-muted">У пользователя нет пройденных тестов</span></div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-material-indigo">
                        <div class="panel-heading">
                            Назначения пользователя
                        </div>
                        <div class="panel-body">
                            <a href="{{route('admin.assigners.users', ['ids' => [$User->id]])}}" class="btn btn-info">Назначить тест</a>
                        </div>
                        @if($Assigners = $User->assigners)
                            <table class="table">
                                <tbody>
                                @foreach($Assigners as $Assigner)
                                    <tr>
                                        <td>{{$Assigner->prototype->title}}</td>
                                        <td>{{$Assigner->date_end}}</td>
                                        <td>
                                            @if($Assigner->test)
                                                <span class="text-primary glyphicon glyphicon-ok"></span>
                                            @else
                                                <span class="text-danger glyphicon glyphicon-ban-circle"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="panel-body text-center"><span class="text-muted">У пользователя нет пройденных тестов</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop