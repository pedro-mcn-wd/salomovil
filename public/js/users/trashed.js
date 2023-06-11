//confirm deleteForceAll
let btn_forceDeleteAll = document.querySelector('#btn-forceDeleteAll');
let modal_deleteAll = document.getElementById("modal_deleteAll");

if(btn_forceDeleteAll != null){
    btn_forceDeleteAll.addEventListener('click', function(event) {
        event.preventDefault();
        modal_deleteAll.style.display = "block";
    });

    document.querySelector('#btn_accept_deleteAll').addEventListener('click', function() {
        btn_forceDeleteAll.submit();
        modal_deleteAll.style.display = "none";
    });

    document.querySelector('#btn_cancel_deleteAll').addEventListener('click', function() {
        modal_deleteAll.style.display = "none";
    });
}

//confirm restoreAll
let btn_restoreAll = document.querySelector('#btn-restoreAll');
let modal_restoreAll = document.getElementById("modal_restoreAll");

if(btn_restoreAll != null){
    btn_restoreAll.addEventListener('click', function(event) {
        event.preventDefault();
        modal_restoreAll.style.display = "block";
    });

    document.querySelector('#btn_accept_restoreAll').addEventListener('click', function() {
        btn_restoreAll.submit();
        modal_restoreAll.style.display = "none";
    });

    document.querySelector('#btn_cancel_restoreAll').addEventListener('click', function() {
        modal_restoreAll.style.display = "none";
    });
}

//confirm forceDelete
let forceDelete_buttons = document.querySelectorAll('.btn-forceDelete');

if(forceDelete_buttons.length>0){
    forceDelete_buttons.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            document.getElementById("modal_forceDelete").style.display = "block";
            console.log(event.target.value);
            //passing the user id to modal form
            let user_id = event.target.value;
            document.getElementById("form_forceDelete").setAttribute("action", "/users_trashed/" + user_id + "/forceDelete");
        });
    });

    document.querySelector('#btn_accept_forceDelete').addEventListener('click', function() {
        document.getElementById("form_forceDelete").submit();
    });

    document.querySelector('#btn_cancel_forceDelete').addEventListener('click', function() {
        document.getElementById("modal_forceDelete").style.display = "none";
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
