//confirm delete
let delete_buttons = document.querySelectorAll('.btn-delete');

if(delete_buttons.length>0){
    delete_buttons.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            document.getElementById("modal_delete").style.display = "block";

            //passing the user id to modal form
            let user_id = event.target.value;
            document.getElementById("form_delete").setAttribute("action", "/users/" + user_id);
        });
    });

    document.querySelector('#btn_accept_delete').addEventListener('click', function() {
        document.getElementById("form_delete").submit();
    });

    document.querySelector('#btn_cancel_delete').addEventListener('click', function() {
        document.getElementById("modal_delete").style.display = "none";
    });
}

//clear filters
document.getElementById('btn_reset_filters').addEventListener('click', function () {

    let input_filters = document.querySelectorAll('.input_filter');
    let select_filters = document.querySelectorAll('.select_filter');

    for (const elem of input_filters) {
        elem.value="";
    }

    for (const elem of select_filters) {
        elem.selectedIndex = 0;
    }
});
