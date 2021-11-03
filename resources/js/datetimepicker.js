$(function(){
    $.fn.datetimepicker.defaults.locale = "id-ID"
    $(".date").datetimepicker({
        format : 'LL'
    });
    $(".time").datetimepicker({
        format : 'HH:mm'
    });
});