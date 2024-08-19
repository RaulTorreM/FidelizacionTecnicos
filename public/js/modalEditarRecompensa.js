let idRecompensaInput = document.getElementById('idRecompensaInput');
let tipoRecompensaInputEdit = document.getElementById('tipoRecompensaInputEdit');
let descripcionRecompensaInputEdit = document.getElementById('descripcionRecompensaInputEdit');
let costoPuntosInput = document.getElementById('costoPuntosInput');
let searchRecompensaError = document.getElementById('searchRecompensaError');

function selectOptionEditarRecompensa(value, idInput, idOptions, someHiddenIdInputsArray, costoPuntos) {
    //Colocar en el input la opción seleccionada 
    selectOption(value, idInput, idOptions); 

    // Extraer id y nombre del valor
    const [id, descripcion] = value.split(' - ');
 
    // Actualizar los demás campos del formulario
    if (id && descripcion) {
      tipoRecompensaInputEdit.value = id;
      descripcionRecompensaInputEdit.value = descripcion;
      costoPuntosInput.value = costoPuntos;


      // Llenar campos ocultos
      document.getElementById(someHiddenIdInputsArray[0]).value = id;
    } else {
		tipoRecompensaInputEdit.value = "";
		descripcionRecompensaInputEdit.value = "";
    }
}
