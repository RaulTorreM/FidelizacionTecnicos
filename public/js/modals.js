function openModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'block';
        setTimeout(function() {
            modal.style.opacity = 1; // Hacer el modal visible de forma gradual
            modal.querySelector('.modal-dialog').classList.add('open');
        }, 50); // Pequeño retraso para asegurar la transición CSS
        document.body.style.overflow = 'hidden'; // Evita el scroll de fondo cuando está abierto el modal
        
        // Recuperar el array de modales abiertos y agregar el nuevo
        let openModals = JSON.parse(localStorage.getItem('openModals')) || [];
        if (!openModals.includes(modalId)) {
            openModals.push(modalId);
            localStorage.setItem('openModals', JSON.stringify(openModals));
        }
    }
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        modal.querySelector('.modal-dialog').classList.remove('open');
        setTimeout(function() {
            modal.style.display = 'none';
        }, 300); // Espera 0.3 segundos (igual a la duración de la transición CSS)
        
         // Elimina el modal de la lista de modales abiertos
         let openModals = JSON.parse(localStorage.getItem('openModals')) || [];
         openModals = openModals.filter(id => id !== modalId);
         if (openModals.length > 0) {
            localStorage.setItem('openModals', JSON.stringify(openModals));
         } else {
            document.body.style.overflow = ''; //Permitir el scroll de fondo luego de cerrar todos los modales
            localStorage.removeItem('openModals');
         }
    }
}

// Verificar longitud de 
/*Selección de archivos, falta agregar la lógica para evitar arrastrar archivos con acceso denegado */
// Función para simular clic en el input file al hacer clic en el botón
function handleFileSelect() {
    document.getElementById('fileInput').click();
}

// Event listener para cuando ya se seleccionó un archivo
document.getElementById('fileInput').addEventListener('change', function() {
    var file = this.files[0]; // Obtener el archivo seleccionado
    if (file) {
        analizarXML(file);
    }
});

function allowDrop(event) {
    event.preventDefault();
    document.getElementById('fileArea').classList.add('drag-over');
}

function removeDrop(event) {
    event.preventDefault();
    document.getElementById('fileArea').classList.remove('drag-over');
}

function handleDrop(event) {
    event.preventDefault();
    document.getElementById('fileArea').classList.remove('drag-over');
}

// Event listener para soltar sobre el área
document.getElementById('fileArea').addEventListener('drop', function(event) {
    event.preventDefault();
    var file = event.dataTransfer.files[0]; // Obtener el archivo soltado
    if (file) {
        checkFileAccess(file).then((isAccessible) => {
            if (isAccessible) {
                analizarXML(file);
            }
        }).catch((error) => {
            console.error('Error al revisar acceso a archivo:', error);
        });
    }
});

// Función para verificar el acceso al archivo usando promesas
function checkFileAccess(file) {
    return new Promise((resolve, reject) => {
        // Comprobar el tipo de archivo
        if (file.type !== 'text/xml' && file.type !== '') {
            console.error('Tipo de archivo no permitido:', file.type);
            reject('Tipo de archivo no permitido');
        }

        // Intentar leer el archivo para verificar el acceso
        const reader = new FileReader();
        reader.readAsText(file);
        reader.onload = function() {
            console.log('Acceso al archivo permitido');
            resolve(true);
        };
        reader.onerror = function() {
            reject('Acceso al archivo denegado');
        };
    });
}

document.addEventListener("DOMContentLoaded", function() {
    closeOptionsOnClickOutside();
    setOnlySelectInputFocusColor();

    let openModals = JSON.parse(localStorage.getItem('openModals')) || [];
    openModals.forEach(modalId => openModal(modalId));
});

function setOnlySelectInputFocusColor() {
    document.   addEventListener('click', function(event) {
        var elements = document.querySelectorAll('.onlySelectInput-container');
        elements.forEach(function(element) {
            var isClickInside = element.contains(event.target);
            if (!isClickInside) {
                element.style.borderColor = '#ccc';
            } else {
                element.style.borderColor = '#007bff'; // Mantener el color de foco si está dentro
            }
        });
    });
}

function toggleOptions(idInput, idOptions) {
    var options = document.getElementById(idOptions);
    var input = document.getElementById(idInput);
    var inputClassName = input.className;

    if (options) {
        if (input.value && inputClassName != "onlySelectInput") {
            filterOptions(idInput, idOptions);
        } else {
            if (options.classList.contains('show')) {
                options.classList.remove('show');
            } else {
                options.classList.add('show');
            }
        }
    }
}

function filterOptions(idInput, idOptions) {
    var input, filter, ul, li, i, txtValue, hasVisibleOptions = false;
    input = document.getElementById(idInput);
    filter = input.value.toUpperCase();
    ul = document.getElementById(idOptions);
    li = ul.getElementsByTagName('li');
    
    for (i = 0; i < li.length;   i++) {
        txtValue = li[i].textContent || li[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            hasVisibleOptions = true;
        } else {
            li[i].style.display = "none";
        }
    }

    if (hasVisibleOptions) {
        ul.classList.add('show');
    } else {
        ul.classList.remove('show');
    }
}

function selectOption(value, idInput, idOptions) {
    var input = document.getElementById(idInput);
    var options = document.getElementById(idOptions);

    if (input) {
        input.value = value;
        options.classList.remove('show'); // Ocultar las opciones
    } else {
        console.error('El elemento con id ' + idOptions + ' no se encontró en el DOM');
    }
}

function clearInput(idInput) {
    var input = document.getElementById(idInput); 
    if (input) {
        input.value = ''; // Limpia el valor del input
    } else {
        console.error('No se encontró un input siguiente para el contenedor ' + container + '.');
    }
}

function closeOptionsOnClickOutside() {
    // Encuentra todos los elementos select en el documento
    var selects = document.querySelectorAll('.input-select');
    
    // Función para manejar el clic fuera del select
    function handleClickOutside(event) {
        var isClickInside = false;

        // Recorre todos los selects y verifica si el clic fue dentro de uno
        selects.forEach(function(select) {
            var options = select.querySelector('ul');
            if (options) {
                if (select.contains(event.target) || options.contains(event.target)) {
                    isClickInside = true;
                } else {
                    options.classList.remove('show');
                }
            }
        });
    }

    // Añadir el event listener de clic en el documento
    document.addEventListener('click', handleClickOutside);
}

function guardarModal(idModal, idForm) {
    document.getElementById(idForm).submit();
    closeModal(idModal);
}

function validateNumberRealTime(input) {
    // Elimina todos los caracteres que no sean dígitos como "e" ó "-"
    input.value = input.value.replace(/[^0-9]/g, '');
}

function validateRealTimeInputLength(input, length) {
    if (input.value.length > length) {
        input.value = input.value.slice(0, length);
    }
}

function validateInputLength(input, length) {
    return input.value.length === length;
}
