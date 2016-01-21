/**
 * Created by djzt4 on 09.01.2016.
 */
    $('body')
        .on('change', '.checkbox-right', check_submit)
        .on('click', '.btn-remove-answer', function(event){
            console.log('action remove answer');
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
                .append($('<input/>',{'type':'checkbox','name':'answers['+(count)+'][right]'}).val('1')
                    .addClass('checkbox-right'), $('<span/>')
                    .addClass('checkbox-material')
                    .append($('<span/>')
                        .addClass('check')))));
    var $btndel = $('<td/>')
        .addClass('text-right')
        .css('width',40)
        .append($('<button/>',{'type':'button','name':'answers['+(count)+'][right]'}).addClass('btn btn-danger btn-xs btn-remove-answer').append($('<span/>').addClass('glyphicon glyphicon-remove')));

    var $tr = $('<tr/>').attr('data-answer-item', count).append($text,$image,$right,$btndel);
    $('#answers').append($tr);

    check_submit();
}