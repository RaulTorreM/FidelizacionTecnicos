let codigoRecompensaInput = document.getElementById('codigoRecompensaInput');
let tipoRecompensaInput = document.getElementById('tipoRecompensaInput');
let descripcionRecompensaTextarea = document.getElementById('descripcionRecompensaTextarea');
let costoUnitarioInput = document.getElementById('costoUnitarioInput');
let registrarRecompensaMessageError = document.getElementById('registrarRecompensaMessageError');

let formInputsArray = [
    codigoRecompensaInput,
	tipoRecompensaInput,
	descripcionRecompensaTextarea,
	costoUnitarioInput, 
];

let mensajeCombinado = "";

function validarCamposVaciosFormulario() {
    let allFilled = true;
    formInputsArray.forEach(input => {
        if (!input.value.trim()) {
            allFilled = false;
        }
    });
    return allFilled;
}

function validarCamposCorrectosFormulario() {
    mensajeCombinado = "";
    var returnError = false;

    if (costoUnitarioInput.value == 0) {
        mensajeCombinado += "El costo unitario no puede ser 0.";
        returnError = true;
	}

    if (returnError) {
        return false;
    }

    registrarRecompensaMessageError.classList.remove("shown");
    return true;
}

function guardarModalRegistrarNuevaRecompensa(idModal, idForm) {
	if (validarCamposVaciosFormulario()) {
		if (validarCamposCorrectosFormulario()) {
			console.log("Enviando formulario satisfactoriamente");
			registrarRecompensaMessageError.classList.remove("shown");
			guardarModal(idModal, idForm);	
		} else {
			registrarRecompensaMessageError.textContent = mensajeCombinado;
			registrarRecompensaMessageError.classList.add("shown");
		}
	} else {
        registrarRecompensaMessageError.textContent = "Todos los campos del formulario deben estar rellenados correctamente.";
        registrarRecompensaMessageError.classList.add("shown");
    }
}