@extends('admin.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8">
                    <a class="btn btn-primary btn-lg" href="{{route('admin.users.create')}}">Создать</a>
                </div>
                <div class="col-lg-4">
                    <input class="form-control" type="text" placeholder="Search">
                </div>
            </div>

        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>E-Mail</th>
                <th>Группа</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($Users as $User)
                    <tr>
                        <td>{{$User->id}}</td>
                        <td>{{$User->first_name}} {{$User->last_name}} {{$User->second_name}}</td>
                        <td>{{$User->email}}</td>
                        <td{{$User->group->title}}></td>
                        <td>{{$User->role->title}}</td>
                        <td></td>
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