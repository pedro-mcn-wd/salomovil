$('.dropify').dropify();

var drEvent = $('.dropify').dropify();

drEvent.on('dropify.beforeClear', function(event, element) {
    return confirm("¿Estás seguro de que quieres eliminar tu avatar?");
});
