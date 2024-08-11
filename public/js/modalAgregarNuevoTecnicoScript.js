var today = new Date();
var minDate = '1900-01-01';
var maxDate = today.toISOString().split('T')[0];

document.addEventListener("DOMContentLoaded", function() {
    var dniInput = document.getElementById('dniInput');
    var phoneInput = document.getElementById('phoneInput');
    var dateInput = document.getElementById('bornDateInput');
    var dateMessageError = document.getElementById('dateMessageError');
    var multiMessageError = document.getElementById('multiMessageError');

    if (dateInput) {
        // Establecer los atributos min y max una sola vez
        dateInput.setAttribute('min', minDate);
        dateInput.setAttribute('max', maxDate);

        dateInput.addEventListener('input', function() {
            validateRealTimeDate();
        });
    }

     // Función para validar la fecha
    function validateRealTimeDate() {
        var selectedDate = dateInput.value;

        // Verificar si el campo de fecha está vacío
        if (!selectedDate) {
            dateMessageError.classList.remove('shown'); 
            return; // Salir de la función si el campo está vacío
        }
        
        if (selectedDate < minDate) {
            dateMessageError.textContent = 'La fecha debe ser posterior al 1 de enero de 1900.'; 
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
        } else if (selectedDate > maxDate) {
            dateMessageError.textContent = 'La fecha debe ser menor a la fecha actual'; 
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
        } else {
            dateMessageError.classList.remove('shown'); // Ocultar mensaje de error
        }
    }
});

function validateDate() {
    var selectedDate = document.getElementById('bornDateInput').value;

    // Verificar si el campo de fecha está vacío
    if (!selectedDate) {
        dateMessageError.classList.remove('shown'); 
        return true; // Salir de la función si el campo está vacío
    }
    
    if (selectedDate < minDate) {
        return false;
    } else if (selectedDate > maxDate) {
        return false;
    } else {
        return true;
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
            //console.log(fields[key].message);
            isValid = false;
        }
    }

    return isValid;
}

function guardarModalAgregarNuevoTecnico(idModal, idForm) {
    // Validar campos del formulario
    if (!validateFormAgregarNuevoTecnico()) {
        multiMessageError.textContent = 'Debe completar todos los campos del formulario.';
        multiMessageError.classList.add('shown');
        console.log("Debe completar todos los campos del formulario.");
        return; // Salir si la validación de campos falla
    }

    // Validar longitud de DNI y celular
    var isDniValid = validateInputLength(dniInput, 8);
    var isPhoneValid = validateInputLength(phoneInput, 9);

    if (!isDniValid && !isPhoneValid) { 
        multiMessageError.innerHTML  = `El campo DNI debe contener 8 caracteres. <br>
                                        El campo Celular debe contener 9 dígitos`; // Template literals → ALT GR + } = `
        multiMessageError.classList.add('shown');
        console.log("El campo DNI debe contener 8 caracteres.");
    } else if (!isDniValid) {
        multiMessageError.textContent = 'El campo DNI debe contener 8 caracteres.';
        multiMessageError.classList.add('shown');
        console.log("El campo DNI debe contener 8 caracteres.");
    } else if (!isPhoneValid) {
        multiMessageError.textContent = 'El campo Celular debe contener 9 dígitos.';
        multiMessageError.classList.add('shown');
        console.log("El campo Celular debe contener 9 dígitos.");
    }

    // Si ambas validaciones de longitud son correctas, enviar el formulario
    if (isDniValid && isPhoneValid && validateDate()) {
        multiMessageError.classList.remove('shown');
        guardarModal(idModal, idForm);
        /*document.getElementById(idForm).submit();
        closeModal(idModal);*/
    }
}