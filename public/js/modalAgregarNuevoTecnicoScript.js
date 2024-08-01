document.addEventListener("DOMContentLoaded", function() {
    var dateInput = document.getElementById('bornDateInput');
    var dateMessageError = document.getElementById('dateMessageError');
    var today = new Date();
    var minDate = '1900-01-01';
    var maxDate = today.toISOString().split('T')[0];

    if (dateInput) {
        // Establecer los atributos min y max una sola vez
        dateInput.setAttribute('min', minDate);
        dateInput.setAttribute('max', maxDate);

        dateInput.addEventListener('input', function() {
            validateDate();
        });
    }

    // Función para validar la fecha
    function validateDate() {
        var selectedDate = dateInput.value;

        // Verificar si el campo de fecha está vacío
        if (!selectedDate) {
            dateMessageError.classList.remove('shown'); // Mostrar mensaje de error
            console.log("Campo de fecha vacío");
            return; // Salir de la función si el campo está vacío
        }
        
        if (selectedDate < minDate) {
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
            dateMessageError.textContent = 'La fecha debe ser posterior al 1 de enero de 1900.'; 
            console.log("funciona 1900");
        } else if (selectedDate > maxDate) {
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
            dateMessageError.textContent = 'La fecha debe ser menor a la fecha actual'; 
            console.log("funciona fecha actual");
        } else {
            dateMessageError.classList.remove('shown'); // Ocultar mensaje de error
        }
    }
});

function validateInputLength(input, length) {
    // Remover caracteres no numéricos
    input.value = input.value.replace(/[^0-9]/g, '');
    
    if (input.value.length > length) {
        input.value = input.value.slice(0, length);
    }
}

function validateFormAgregarNuevoTecnico() {
    // Obtener referencias a los campos de entrada
    var dniInput = document.getElementById('dniInput');
    var nameInput = document.getElementById('nameInput');
    var phoneInput = document.getElementById('phoneInput');
    var oficioInput = document.getElementById('oficioInput');
    var fechaNacimientoInput = document.getElementById('bornDateInput');

    // Crear un objeto con las entradas y sus respectivos mensajes de error
    var fields = {
        dni: { value: dniInput.value, message: "DNI vacío" },
        name: { value: nameInput.value, message: "Nombre vacío" },
        phone: { value: phoneInput.value, message: "Celular vacío" },
        oficio: { value: oficioInput.value, message: "Oficio vacío" },
        fechaNacimiento: { value: fechaNacimientoInput.value, message: "Fecha de nacimiento vacío" },
    };

    // Verificar si todos los campos están llenos
    var isValid = true;
    for (var key in fields) {
        if (!fields[key].value) {
            console.log(fields[key].message);
            isValid = false;
        }
    }

    return isValid;
}

function guardarModalAgregarNuevoTecnico(idModal, idForm) {
    if (validateFormAgregarNuevoTecnico()) {
        document.getElementById(idForm).submit();
        closeModal(idModal);
    } else {
        console.log("No es un formulario valido")
    }
}