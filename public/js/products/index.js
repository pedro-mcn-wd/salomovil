//confirm delete
let delete_buttons = document.querySelectorAll('.btn-delete');

if(delete_buttons.length>0){
    delete_buttons.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            document.getElementById("modal_delete").style.display = "block";

            //passing the user id to modal form
            let prod_id = event.target.value;
            document.getElementById("form_delete").setAttribute("action", "/products/" + prod_id);
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
        if(elem.id == "subcategory" || elem.id == "sort_by_field"){
            elem.setAttribute('disabled', true);
        }
        elem.selectedIndex = 0;
    }
});

//dependent select subcategories
document.addEventListener('DOMContentLoaded', function() {
    let idCategorySelected = document.getElementById('category').value;
    showSelectSubcategoriesDependent(idCategorySelected);
});

document.getElementById('category').addEventListener('change', function(event) {
    let idCategorySelected = event.target.value;
    showSelectSubcategoriesDependent(idCategorySelected);
});

function showSelectSubcategoriesDependent(idCategorySelected){
    let selectSubcategories = document.getElementById('subcategory');
    let optionsSelectSubcategories = document.querySelectorAll('#subcategory option');

    if(idCategorySelected != "") {
        selectSubcategories.removeAttribute('disabled');
        for (const option of optionsSelectSubcategories) {
            option.classList.contains('hidden') ?  "" : option.classList.add('hidden');
        }

        for (const option of optionsSelectSubcategories) {
            option.dataset.cat_id == idCategorySelected ? option.classList.remove('hidden') : "";
        }
        optionsSelectSubcategories[0].classList.contains('hidden') ? optionsSelectSubcategories[0].classList.remove('hidden') : "";
    }else{
        for (const option of optionsSelectSubcategories) {
            option.classList.contains('hidden') ?  "" : option.classList.add('hidden');
        }
        optionsSelectSubcategories[0].classList.contains('hidden') ? optionsSelectSubcategories[0].classList.remove('hidden') : "";
        selectSubcategories.selectedIndex = 0;
        selectSubcategories.setAttribute('disabled', true);
    }
}

//selects sorting
document.addEventListener('DOMContentLoaded', function() {
    let valueSortInOrder = document.getElementById('sort_in_order').value;
    let sltSortByField = document.getElementById('sort_by_field');

    if(valueSortInOrder == ""){
        sltSortByField.selectedIndex = 0;
        sltSortByField.setAttribute('disabled', true);
    }else{
        sltSortByField.removeAttribute('disabled');
    }
});

document.getElementById('sort_in_order').addEventListener('change', function(event) {
    let valueSortInOrder = event.target.value;
    let sltSortByField = document.getElementById('sort_by_field');

    if(valueSortInOrder == ""){
        sltSortByField.selectedIndex = 0;
        sltSortByField.setAttribute('disabled', true);
    }else{
        sltSortByField.removeAttribute('disabled');
    }
});
