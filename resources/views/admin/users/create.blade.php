@extends('admin.app')
@section('content')
    <?php $create = true;?>
    <div class="panel panel-info">
        <div class="panel-heading р4">Создание пользователя</div>
        <div class="panel-body">
            <form action="{{route('admin.users.store')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                {{--// TODO проверить везде токены--}}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label" for="first_name">Имя</label>
                            <input id="first_name" class="form-control" type="text" name="first_name" required>
                        </div>
                    </div>
                    {{--TODO Поставить звездочки --}}
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label class="control-label" for="last_name">Фамилия</label>
                            <input id="last_name" class="form-control" type="text" name="last_name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label" for="second_name">Отчество</label>
                            <input id="second_name" class="form-control" type="text" name="second_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input id="email" class="form-control" type="text" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="group">Группа</label>
                    @if($Groups->count())
                        <?php $create = false; ?>
                        <select name="group_id" id="group" class="form-control">
                            <option value="0"></option>
                            @foreach($Groups as $Group)
                                <option value="{{$Group->id}}">{{$Group->title}}</option>
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
                    <label for="role">Roles</label>
                    @if($Roles->count())
                        <?php $create = false; ?>
                        <select class="form-control" name="role_id" id="role" required>
                            @foreach($Roles as $Role)
                                <option value="{{$Role->id}}">{{$Role->title}}</option>
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
                    <button class="btn btn-primary" {{($create)? "disabled":""}}>Сохранить</button>
                </div>
            </form>
        </div>
    </div>

@stop