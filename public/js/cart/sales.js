//clear filters
document.getElementById('btn_reset_filters').addEventListener('click', function () {

    let input_filters = document.querySelectorAll('.input_filter');

    for (const elem of input_filters) {
        elem.value="";
    }
});
