
$(document).ready(function(){
    $('[data-toggle="construction"]').popover({
        placement : 'top',
        trigger : 'hover'
    });

//Keep button select
$(".btn-group").on('click', 'li a', function(){
        $(this).parent().parent().siblings(".btn:first-child").html($(this).text()+' <span class="caret"></span>');
        $(this).parent().parent().siblings(".btn:first-child").val($(this).text());
    });
});

