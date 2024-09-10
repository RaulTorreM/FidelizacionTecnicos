let tecnicoCanjesInput = document.getElementById('tecnicoCanjesInput');
let tecnicoCanjesTooltip = document.getElementById('idTecnicoCanjesTooltip');
let puntosActualesCanjesInput = document.getElementById('puntosActualesCanjesInput');

function getFormattedDate() {
    let today = new Date();
    let day = String(today.getDate()).padStart(2, '0'); // Obtener el día y añadir un 0 si es necesario
    let month = String(today.getMonth() + 1).padStart(2, '0'); // Obtener el mes y añadir un 0 si es necesario
    let year = today.getFullYear(); // Obtener el año

    return `${year}-${month}-${day}`; // Formato YYYY-MM-DD (requerido para inputs tipo date)
}

let date = getFormattedDate();

document.addEventListener("DOMContentLoaded", function() {
    let fechaCanjeInput = document.getElementById('idFechaCanjeInput');
    fechaCanjeInput.value = date;  // Asigna la fecha en formato YYYY-MM-DD
});

function selectOptionNumComprobanteCanjes(value, idInput, idOptions) {
    if (tecnicoCanjesInput.value) {
        selectOption(value, idInput, idOptions); 
        console.log("Si existe valor en tecnicos");
        return;
    }

    showHideTooltip(tecnicoCanjesTooltip, "Seleccione Técnico primero");
}

function validateOptionTecnicoCanjes(input, idOptions, idMessageError, tecnicosDB) {
    const value = input.value;
    const messageError = document.getElementById(idMessageError);

    // Obtener todos los valores del item (la función está en dashboardScrip.js)
    const allItems = getAllLiText(idOptions);

    // Comparar el valor ingresado con la lista de items 
    const itemEncontrado = allItems.includes(value);
    const [idTecnico, nombreTecnico] = value.split(' - ');

    if (!itemEncontrado && value)  {
        messageError.classList.add('shown'); 
        puntosActualesCanjesInput.value = "";
    }
    else {
        messageError.classList.remove('shown');
        const puntosTecnicoIngresado = returnPuntosActualesDBWithRequestedTecnicoID(idTecnico, tecnicosDB);
        puntosActualesCanjesInput.value = puntosTecnicoIngresado;
    }
}

function selectOptionTecnicoCanjes(value, idInput, idOptions, puntosActuales) {
    selectOption(value, idInput, idOptions);
    puntosActualesCanjesInput.value = puntosActuales;
}

function returnPuntosActualesDBWithRequestedTecnicoID(idTecnico, tecnicosDB) {
    for (const key in tecnicosDB) {
        if (tecnicosDB[key]["idTecnico"] === idTecnico) {
            return tecnicosDB[key]["totalPuntosActuales_Tecnico"];
        }
    }
    return null; 
}
