let codigoRecompensaInput = document.getElementById('codigoRecompensaInput');
let tipoRecompensaInput = document.getElementById('tipoRecompensaInput');
let descripcionRecompensaTextarea = document.getElementById('descripcionRecompensaTextarea');
let costoUnitarioInput = document.getElementById('costoUnitarioInput');

let formInputsArray = [
    codigoRecompensaInput,
	tipoRecompensaInput,
	descripcionRecompensaTextarea,
	costoUnitarioInput, 
];

function validarCamposVacíosFormulario() {
    let allFilled = true;
    formInputsArray.forEach(input => {
        if (!input.value.trim()) {
            allFilled = false;

        }
    });
    return allFilled;
}

function guardarModalRegistrarNuevaRecompensa(idModal, idForm) {

}