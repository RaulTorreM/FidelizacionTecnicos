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

        dateInput.addEventListener('blur', function() {
            validateDate();
        });
    }

    // Función para validar la fecha
    function validateDate() {
        var selectedDate = dateInput.value;
        if (selectedDate < minDate) {
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
            dateMessageError.textContent = 'La fecha debe ser posterior al 1 de enero de 1900.'; 
        } else if (selectedDate > maxDate) {
            dateMessageError.classList.add('shown'); // Mostrar mensaje de error
            dateMessageError.textContent = 'La fecha debe ser menor a la fecha actual'; 
        } else {
            dateMessageError.classList.remove('shown'); // Ocultar mensaje de error
        }
    }
});

function validateInputLength(input, length) {
    // Remover caracteres no numéricos
    input.value = input.value.replace(/[^0-9]/g, '');
    
    // Limitar a 8 dígitos
    if (input.value.length > length) {
        input.value = input.value.slice(0, length);
    }
}