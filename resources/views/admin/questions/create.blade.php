@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <form action="{{route('admin.questions.store', $Prototype)}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Текст вопроса</label>
                    <textarea class="form-control" name="question[text]" rows="5">{{old('question.text')}}</textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Изображение</label>
                            <input class="btn btn-info" type="file" name="question[image]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Тип ответов</label>
                            @foreach($Types as $Type)
                                <div class="radio radio-primary">
                                    <label>
                                        @if($Type->title == old('question.type', 'radio'))
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
                    <div class="col-lg-3">
                        <label for="">Коеффициент сложности</label>
                        <input class="form-control" type="number" name="question[coefficient]" min="0" max="100" value="{{old('question.coefficient', 1)}}">
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
                        @if(old('answers'))
                            @foreach(old('answers') as $key => $oldAnswer)
                                <tr data-answer-item="{{$key}}">
                                    <td>
                                        <input type="text" class="form-control" name="answers[{{$key}}][text]" value="{{$oldAnswer['text']}}">
                                    </td>
                                    <td>
                                        <input type="file" class="btn btn-info btn-xs btn-block" name="answers[{{$key}}][image]" value="{{$oldAnswer['image']}}">
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                @if(isset($oldAnswer['right']))
                                                    <input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]" checked>
                                                @else
                                                    <input type="checkbox" class="form-control checkbox-right" name="answers[{{$key}}][right]">
                                                @endif
                                                <span class="checkbox-material"><span class="check"></span></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <input id="btn-save" type="submit" class="btn btn-primary" value="Сохранить">
            </div>
        </form>
    </div>
@stop
@section('js')

    <script type="text/javascript">


        $('body')
                .on('change', '.checkbox-right', check_submit)
                .on('click', '.btn-remove-answer', function(event){
                    var $el = $(event.currentTarget);
                    $el.closest('tr').remove();
                    check_submit();
                });

        $('.btn-add-answer').on('click', addTrAnswer);

        // Пересчет возможности создания вопроса
        function check_submit(){
            var $btn = $('#btn-save');
            if( $("#answers > tr").length >= 2 && $('.checkbox-right:checked').length >= 1){
                $btn.prop('disabled', false)
            }else{
                $btn.prop('disabled', true)
            }
        }
        check_submit();

        function addTrAnswer(){
            var count   = $("#answers > tr").length;
            var $text   = $('<td/>').append($('<input/>',{'class':'form-control','type':'text',    'name':'answers['+(count)+'][text]'}));
            var $image  = $('<td/>').append($('<input/>',{'class':'btn btn-info btn-block btn-xs','type':'file', 'name':'answers['+(count)+'][image]'}));
            var $right  = $('<td/>')
                    .addClass('text-right')
                    .append($('<div/>')
                            .addClass('checkbox')
                            .append($('<label/>')
                                    .append($('<input/>',{'type':'checkbox','name':'answers['+(count)+'][right]'})
                                            .addClass('checkbox-right'), $('<span/>')
                                            .addClass('checkbox-material')
                                            .append($('<span/>')
                                                    .addClass('check')))));
            var $btndel = $('<td/>')
                    .addClass('text-right')
                    .css('width',40)
                    .append($('<button/>',{'type':'button','name':'answers['+(count)+'][right]'}).addClass('btn btn-danger btn-xs').append($('<span/>').addClass('glyphicon glyphicon-remove')));

            var $tr = $('<tr/>').attr('data-answer-item', count).append($text,$image,$right,$btndel);
            $('#answers').append($tr);

            check_submit();
        }
    </script>

@stop