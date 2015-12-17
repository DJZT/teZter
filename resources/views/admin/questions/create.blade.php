@extends('admin.app')
@section('content')
    <div class="panel panel-default">
        <form action="{{route('admin.questions.store', $Prototype)}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="panel-body">

                <div class="form-group">
                    <label for="">Текст вопроса</label>
                    <textarea class="form-control" name="question[text]" rows="5"></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Изображение</label>
                            <input class="btn btn-info" type="file" name="question[image]">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Тип ответов</label>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="question[multi]" value="false" checked=""><span class="circle"></span><span class="check"></span>
                                    Один ответ
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="question[multi]" value="true" checked=""><span class="circle"></span><span class="check"></span>
                                    Много ответов
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
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
                        <th style="width: 30%">Изображение</th>
                        <th class="text-right">Правильный</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="answers"></tbody>
                </table>
                <input id="btn-save" type="submit" class="btn btn-primary" value="Сохранить">
            </div>
        </form>
    </div>
@stop
@section('js')

    <script type="text/javascript">

        var count = $("#answers > tr").length;
        $('.btn-add-answer').on('click', addTrAnswer);

        function check_submit(){
            var $btn = $('#btn-save');
            if($('.checkbox-right:checked').length >= 1 && $("#answers > tr").length >= 2){
                $btn.prop('disabled', false)
            }else{
                $btn.prop('disabled', true)
            }
        }
        check_submit();

        function addTrAnswer(){

            var $text   = $('<td/>').append($('<input/>',{'class':'form-control','type':'text',    'name':'answers['+(count+1)+'][text]'}));
            var $image  = $('<td/>').css('width',60).append($('<input/>',{'class':'btn btn-info btn-block btn-xs','type':'file',    'name':'answers['+(count+1)+'][image]'}));
            var $right  = $('<td/>')
                    .addClass('text-right')
                    .css('width',40)
                    .append($('<div/>')
                            .addClass('checkbox')
                            .append($('<label/>')
                                    .append($('<input/>',{'type':'checkbox','name':'answers['+(count+1)+'][right]'})
                                            .addClass('checkbox-right')
                                            .on('change', function(){
                                                check_submit();
                                            }), $('<span/>')
                                            .addClass('checkbox-material')
                                            .append($('<span/>')
                                                    .addClass('check')))));
            var $btndel = $('<td/>')
                    .addClass('text-right')
                    .css('width',40)
                    .append($('<button/>',{'type':'button','name':'answers['+(count+1)+'][right]'})
                            .on('click', function(event){
                                var $el = $(event.currentTarget);
                               $el.closest('tr').remove();
                                check_submit();
                    }).addClass('btn btn-danger btn-xs').append($('<span/>').addClass('glyphicon glyphicon-remove')));

            var $tr = $('<tr/>').attr('answer-item', ++count).append($text,$image,$right,$btndel);
            $('#answers').append($tr);

            check_submit();
        }
    </script>

@stop