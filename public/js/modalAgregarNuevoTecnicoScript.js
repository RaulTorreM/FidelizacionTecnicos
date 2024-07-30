document.addEventListener("DOMContentLoaded", function() {
    var dateInput = document.getElementById('bornDateInput');
    if (dateInput) {
        dateInput.addEventListener('blur', function() {
            validateYear(this);
        });
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

function validateYear(input) {
    if (input.value) {
        // Crear un objeto Date a partir del valor del campo
        let selectedDate = new Date(input.value);
        let year = selectedDate.getFullYear();
        let currentYear = new Date().getFullYear();

        // Verificar si el año está fuera del rango permitido
        if (year < 1900 || year > currentYear) {
            // Mostrar un mensaje de error si el año es inválido
            console.error('El año debe estar entre 1900 y el año actual.');
            input.style.borderColor = 'red'; // Opcional: resaltar borde en rojo
        } else {
            // Lógica si el año es válido
            console.log('El año es válido.');
            input.style.borderColor = ''; // Restaurar borde original
        }
    } else {
        console.error('No se ha ingresado ninguna fecha.');
        input.style.borderColor = ''; // Restaurar borde original si no hay fecha
    }
}

