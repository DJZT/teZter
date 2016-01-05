@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <table class="table">
            <tbody>
            @foreach($Users as $User)
                <tr>
                    <td>{{$User->getName()}}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
            <tr class="panel-body">
                <td class="form-group">
                    <label for="">Выберите тест</label>
                    @if($Prototypes->count())
                        <select name="prototype_id" id="">
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
                </td>
            </tr>
        </table>
    </div>
@stop