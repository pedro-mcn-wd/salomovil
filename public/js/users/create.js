$('.dropify').dropify();

jQuery(function() {
    $('#roles').on(function() {
        if ($(this).val() == 'cliente/a') {
            $('#dni-input').show();
        } else {
            $('#dni-input').hide();
        }
    });
});
