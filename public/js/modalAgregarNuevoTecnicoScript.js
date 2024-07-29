function validateInputLength(input, length) {
	// Remover caracteres no numéricos
	input.value = input.value.replace(/[^0-9]/g, '');
	
	// Limitar a 8 dígitos
	if (input.value.length > length) {
	  input.value = input.value.slice(0, length);
	}
  }