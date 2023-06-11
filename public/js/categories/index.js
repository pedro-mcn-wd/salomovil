//confirm delete
let delete_buttons = document.querySelectorAll('.btn-delete');

if(delete_buttons.length>0){
    delete_buttons.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            document.getElementById("modal_delete").style.display = "block";

            //passing the user id to modal form
            let cat_id = event.target.value;
            document.getElementById("form_delete").setAttribute("action", "/categories/" + cat_id);
        });
    });

    document.querySelector('#btn_accept_delete').addEventListener('click', function() {
        document.getElementById("form_delete").submit();
    });

    document.querySelector('#btn_cancel_delete').addEventListener('click', function() {
        document.getElementById("modal_delete").style.display = "none";
    });
}
