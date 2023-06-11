$('.dropify').dropify();

$(document).ready(function() {
    // Inicializar Dropify en el campo de entrada de archivos
    $('.dropify').dropify();

    // Escuchar el evento 'change' en el campo de entrada de archivos
    $('#images_products').on('change', function() {
        var filePreviewContainer = $('#preview_images_container');
        var files = $(this)[0].files;
        filePreviewContainer.empty();
        var maxImages = 8;

        // Verificar la cantidad actual de imágenes en el contenedor
        var currentImageCount = filePreviewContainer.children('div.image-preview').length;
        var remainingSlots = maxImages - currentImageCount;

        // Verificar si hay suficientes espacios disponibles para agregar las imágenes seleccionadas
        if (files.length > remainingSlots) {
            alert('Solo se permiten un máximo de ' + maxImages + ' imágenes');
            // Limpiar el campo de entrada de archivos si se excede el límite
            $(this).val('');
            return;
        }

        var promises = [];
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            var promise = new Promise(function(resolve, reject) {
                reader.onload = function(e) {
                    var thumbnailContainer = $('<div>').addClass('image-preview relative');
                    var filePreview = $('<img>').attr('src', e.target.result);
                    var deleteButton = $('<a>').addClass('delete-button absolute top-0 right-0 w-6 h-6 bg-white text-center align-middle cursor-pointer');
                    var iconTrash = $(`<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>`);

                    thumbnailContainer.append(filePreview);
                    deleteButton.append(iconTrash);
                    thumbnailContainer.append(deleteButton);
                    filePreviewContainer.append(thumbnailContainer);

                    resolve();
                };

                reader.onerror = function(e) {
                    reject(e);
                };

                reader.readAsDataURL(file);
            });

            promises.push(promise);
        }

        Promise.all(promises)
            .then(function() {
                console.log('Todas las miniaturas se han cargado correctamente.');
            })
            .catch(function(error) {
                console.error('Ocurrió un error al cargar las miniaturas:', error);
            });
    });

    // Escuchar el evento de clic en el botón de eliminación
    $('#preview_images_container').on('click', '.delete-button', function() {
        var thumbnailContainer = $(this).closest('.image-preview');
        var imageIndex = thumbnailContainer.index('.image-preview');
        thumbnailContainer.remove();

        // Eliminar el archivo correspondiente del campo de entrada de archivos
        var filesInput = $('#images_products')[0];
        if (filesInput.files && filesInput.files.length > imageIndex) {
            var remainingFiles = Array.from(filesInput.files);
            remainingFiles.splice(imageIndex, 1);
            filesInput.files = createFileList(remainingFiles);
        }
    });

});

// Función para crear un nuevo objeto FileList
function createFileList(files) {
    var fileList = new DataTransfer();
    for (var i = 0; i < files.length; i++) {
      fileList.items.add(files[i]);
    }
    return fileList.files;
}

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

    for (const option of optionsSelectSubcategories) {
        option.classList.contains('hidden') ?  "" : option.classList.add('hidden');
    }

    let idOptionObtained = false;
    let indexFirstOptionVisible = null;
    let i = 0;

    for (i; i<optionsSelectSubcategories.length; i++) {
        if(optionsSelectSubcategories[i].dataset.cat_id == idCategorySelected){
            optionsSelectSubcategories[i].classList.remove('hidden');
            if(!idOptionObtained){
                indexFirstOptionVisible = i;
                idOptionObtained = true;
            }
        }
    }

    selectSubcategories.selectedIndex = indexFirstOptionVisible;
}
