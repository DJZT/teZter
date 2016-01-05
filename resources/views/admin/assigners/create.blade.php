@extends('admin.app')
@section('content')
    <form action="{{route('admin.assigners.store')}}" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody>
                    @foreach($Users as $User)
                        <tr>
                            <td>
                                <input type="hidden" name="ids[]" value="{{$User->id}}">
                                {{$User->getName()}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <label for="">Выберите тест</label>
                    @if($Prototypes->count())
                        <select class="form-control" name="prototype_id">
                            @foreach($Prototypes as $Prototype)
                                <option value="{{$Prototype->id}}">{{$Prototype->title}}</option>
                            @endforeach
                        </select>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                Нет тестов. <a href="{{route('admin.prototypes.create')}}" class="btn btn-info btn-xs">Создать</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group" style="position: relative;">
                    <label for="">Дата действия</label>
                    <input class="form-control datetime-picker" type="text">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Создать">
                </div>
            </div>
        </div>
    </form>
@stop