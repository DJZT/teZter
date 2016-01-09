@extends('admin.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <a class="btn btn-primary" href="{{route('admin.users.create')}}">Создать</a>
                    <input id="assigner_test" type="submit" class="btn btn-info" form="selects" value="Назначить тест">
                </div>
                <div class="col-lg-4">
                    <input class="form-control" type="text" placeholder="Search">
                </div>
            </div>
        </div>
        <form id="selects" action="{{route('admin.assigners.users')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
        <table class="table table-hover table-link">
            <thead>
            <tr>
                <th colspan="2">ID</th>
                <th>Фамилия</th>
                <th>E-Mail</th>
                <th>Группа</th>
                <th>Роль</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($Users as $User)
                    <tr {{($User->deleted_at)? "class=text-muted": ""}}>
                        <th>
                            @if(!$User->deleted_at)
                                <div class="checkbox" style="margin: 0;">
                                    <label>
                                        <input class="selects" type="checkbox" form="selects" name="ids[]" value="{{$User->id}}">
                                    <span class="checkbox-material">
                                        <span class="check"></span>
                                    </span>
                                    </label>
                                </div>
                            @endif
                        </th>
                        <th>#{{$User->id}}</th>
                        <td>{{$User->first_name}} {{$User->last_name}} {{$User->second_name}}</td>
                        <td>{{$User->email}}</td>
                        <td>
                            @if($Group = $User->group)
                                <a href="{{route('admin.groups.edit', $Group)}}">{{$Group->title}}</a>
                            @endif
                        </td>
                        <td>
                            @if($Role = $User->role)
                                {{$Role->title}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if($User->deleted_at)
                                <a class="btn btn-success btn-xs" href="{{route('admin.users.restore', $User)}}"><span class="glyphicon glyphicon-repeat"></span></a>
                            @endif
                            <a href="{{route('admin.users.edit', $User)}}" class="btn btn-warning btn-xs btn-no-margin"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a class="btn btn-danger btn-xs btn-no-margin" href="{{route('admin.users.delete', $User)}}" onclick="return confirm('Вы действительно хотите удалить пользователя {{$User->getName()}}?')"><span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-body">
            {!! $Users->render()!!}
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createUserLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="createForm">
                        <div class="form-group">
                            <label for="first_name">Имя</label>
                            <input id="first_name" class="form-control" type="text" name="first_name">
                        </div>
                        <div class="form-group">
                            <label for="second_name">Фамилия</label>
                            <input id="second_name" class="form-control" type="text" name="second_name">
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input id="email" class="form-control" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input id="password" class="form-control" type="password" name="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $('input.selects').on('change', checkSelects);

        function checkSelects(){
            $('#assigner_test').prop('disabled', !$('input.selects:checked').length);
        }
        checkSelects();
    </script>
@stop