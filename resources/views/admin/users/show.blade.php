@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="ro">
                <div class="col-lg-6">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Имя</th>
                                <td>{{$User->first_name}}</td>
                            </tr>
                            <tr>
                                <th>Фамилия</th>
                                <td>{{$User->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Отчество</th>
                                <td>{{$User->second_name}}</td>
                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td><a href="{{route('admin.users.sendmail')}}">{{$User->email}}</a></td>
                            </tr>
                            <tr>
                                <th>Группа</th>
                                <td>{{$User->group->title}}</td>
                            </tr>
                            <tr>
                                <th>Роль</th>
                                <td>{{$User->role->title}}</td>
                            </tr>

                            <tr>
                                <th>Дата регистрации</th>
                                <td>{{$User->created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if($Tests = $User->tests)
                        <table class="table">
                            <tbody>
                            @foreach($Tests as $Test)
                                <tr>
                                    <td><a href="{{route('admin.test.show')}}">{{$Test->prototype->title}}</a></td>
                                    <td>{{$Test->prototype->questions()->count()}}</td>
                                    <td>{{$Test->result()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center"><span class="text-muted">У пользователя нет пройденных тестов</span></div>
                        <div class="text-center"><a href="{{route('admin.tests.assignment')}}" class="btn btn-info">Назначить тест</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop