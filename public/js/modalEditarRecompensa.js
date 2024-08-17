let idRecompensaInput = document.getElementById('idRecompensaInput');
let tipoRecompensaInputEdit = document.getElementById('tipoRecompensaInputEdit');
let descripcionRecompensaInputEdit = document.getElementById('descripcionRecompensaInputEdit');


function selectOptionEditarRecompensa(value, idInput, idOptions) {
    //Colocar en el input la opción seleccionada 
    selectOption(value, idInput, idOptions); 
	console.log("SELECCIONADO OPCION DE MODAL EDITAR RECOMPENSA");
    // Extraer id y nombre del valor
    const [id, descripcion] = value.split(' - ');
    
    // Actualizar los demás campos del formulario
    if (id) {
        idRecompensaInput.value = id;
		tipoRecompensaInputEdit.value = id;
		descripcionRecompensaInputEdit.value = descripcion;
    } else {
        idRecompensaInput.value = "";
		tipoRecompensaInputEdit.value = "";
		descripcionRecompensaInputEdit.value = "";
    }


    var nuevaVentaMessageError = document.getElementById('nuevaVentaMessageError');
    nuevaVentaMessageError.classList.remove('shown'); 
}