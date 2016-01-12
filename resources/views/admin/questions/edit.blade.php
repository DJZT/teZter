@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <form action="{{route('admin.questions.update', $Question)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Текст вопроса</label>
                    <textarea class="form-control" name="question[text]" rows="5">{{old('question.text', $Question->text)}}</textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Изображение</label>
                            @if($Question->image)
                                <img class="img-responsive" src="/{{$Question->image}}" alt="">
                            @endif
                            <input class="btn btn-info btn-block" type="file" name="image">
                            @if($Question->image)
                                <div class="checkbox">
                                    Удалить изображение
                                    <label>
                                        <input type="checkbox" name="question[delete_image]" value="on">
                                        <span class="checkbox-material"><span class="check"></span></span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Тип ответов</label>
                            @foreach($Types as $Type)
                                <div class="radio radio-primary">
                                    <label>
                                        @if($Type->title == old('question.type', $Question->type))
                                            <input type="radio" name="question[type]" value="{{$Type->title}}" checked><span class="circle"></span><span class="check"></span>
                                        @else
                                            <input type="radio" name="question[type]" value="{{$Type->title}}"><span class="circle"></span><span class="check"></span>
                                        @endif
                                        {{$Type->title}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Ответы</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button" class="btn btn-info btn-add-answer">Добавить ответ</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Ответ</th>
                        <th style="width: 200px">Изображение</th>
                        <th class="text-center text-success" style="width: 40px"><span class="glyphicon glyphicon-check"></span></th>
                        <th style="width: 100px"></th>
                    </tr>
                    </thead>
                    <tbody id="answers">
                    @if($Question->answers()->count())
                        @foreach($Question->answers as $key => $Answer)
                            <tr class="warning" data-answer-item="{{$key}}">
                                <td>
                                    <input type="hidden" name="answers[{{$key}}][id]" value="{{$Answer->id}}">
                                    <input type="text" class="form-control" name="answers[{{$key}}][text]" value="{{$Answer->text}}">
                                </td>
                                <td>
                                    @if($Answer->image)
                                        <a href="#">
                                            <img class="img-responsive" src="\{{$Answer->image}}" alt="">
                                        </a>
                                    @endif
                                    <input type="file" class="btn btn-info btn-xs btn-block" name="answers[{{$key}}][image]">
                                        @if($Answer->image)
                                            <div class="checkbox">
                                                Удалить изображение
                                                <label>
                                                    <input type="checkbox" name="answers[{{$key}}][delete_image]" value="on">
                                                    <span class="checkbox-material"><span class="check"></span></span>
                                                </label>
                                            </div>
                                        @endif
                                </td>
                                <td class="text-right">
                                    <div class="checkbox">
                                        <label>
                                            @if($Answer->right)
                                                <input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]" value="1" checked>
                                            @else
                                                <input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]" value="1">
                                            @endif
                                            <span class="checkbox-material"><span class="check"></span></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-danger btn-xs btn-remove-answer"><span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    {{--@if(old('answers'))--}}
                        {{--@foreach(old('answers') as $key => $oldAnswer)--}}
                            {{--<tr data-answer-item="{{$key}}">--}}
                                {{--<td>--}}
                                    {{--<input type="text" class="form-control" name="answers[{{$key}}][text]" value="{{$oldAnswer['text']}}">--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<input type="file" class="btn btn-info btn-xs btn-block" name="answers[{{$key}}][image]" value="{{$oldAnswer['image']}}">--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--@if(isset($oldAnswer['right']))--}}
                                                {{--<input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]" checked>--}}
                                            {{--@else--}}
                                                {{--<input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]">--}}
                                            {{--@endif--}}
                                            {{--<span class="checkbox-material"><span class="check"></span></span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    </tbody>
                </table>
                <input id="btn-save" type="submit" class="btn btn-primary" value="Сохранить">
            </div>
        </form>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="{{asset('js/admin/question.js')}}"></script>
@stop