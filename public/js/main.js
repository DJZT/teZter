$(document).ready(function(){
    $('.date-picker').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM-DD'
    });

    $('.datetime-picker').datetimepicker({
        viewMode: 'days',
        sideBySide: true,
        format: 'YYYY-MM-DD h:mm:ss'
    });
});