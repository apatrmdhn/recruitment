function confirmRedirect(msg, url) {
    bootbox.confirm(msg, function(delete_record){
        if (delete_record) {
            location.href = url;
        }
    });
}


$(document).ready(function () {

    $('[data-field-role="date"]').each(function() {
        $(this).datepicker({'format': 'yyyy-mm-dd'});
    });


});
