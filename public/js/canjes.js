let tecnicoCanjesInput = document.getElementById('tecnicoCanjesInput');
let tecnicoCanjesTooltip = document.getElementById('idTecnicoCanjesTooltip');
let numComprobanteCanjesTooltip = document.getElementById('idNumComprobanteCanjesTooltip');
let numComprobanteCanjesInput = document.getElementById('comprobanteCanjesInput')
let puntosActualesCanjesInput = document.getElementById('puntosActualesCanjesInput');

function getFormattedDate() {
    let today = new Date();
    let day = String(today.getDate()).padStart(2, '0'); // Obtener el día y añadir un 0 si es necesario
    let month = String(today.getMonth() + 1).padStart(2, '0'); // Obtener el mes y añadir un 0 si es necesario
    let year = today.getFullYear(); // Obtener el año

    return `${year}-${month}-${day}`; // Formato YYYY-MM-DD (requerido para inputs tipo date)
}

let date = getFormattedDate();
let tecnicoFilledCorrectlySearchField = false;

document.addEventListener("DOMContentLoaded", function() {
    let fechaCanjeInput = document.getElementById('idFechaCanjeInput');
    fechaCanjeInput.value = date;  // Asigna la fecha en formato YYYY-MM-DD
});

function selectOptionNumComprobanteCanjes(value, idInput, idOptions) {
    if (tecnicoCanjesInput.value && tecnicoFilledCorrectlySearchField) {
        selectOption(value, idInput, idOptions); 
        return;
    } 

    showHideTooltip(tecnicoCanjesTooltip, "Seleccione un Técnico primero");
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
        numComprobanteCanjesInput.value = "";
        tecnicoFilledCorrectlySearchField = false;
    }
    else {
        messageError.classList.remove('shown');
        const puntosTecnicoIngresado = returnPuntosActualesDBWithRequestedTecnicoID(idTecnico, tecnicosDB);
        puntosActualesCanjesInput.value = puntosTecnicoIngresado;
        tecnicoFilledCorrectlySearchField = true;
    }
}

function selectOptionTecnicoCanjes(value, idInput, idOptions, puntosActuales, idTecnico) {
    selectOption(value, idInput, idOptions);
    puntosActualesCanjesInput.value = puntosActuales;
    filterNumComprobantesInputWithTecnico(idTecnico);
    tecnicoFilledCorrectlySearchField = true;
}

function selectOptionRecompensaCanjes(value, idInput, idOptions) {
    if(!numComprobanteCanjesInput.value) {
        showHideTooltip(numComprobanteCanjesTooltip, "Seleccione un Número de comprobante primero");
        return;
    }

    selectOption(value, idInput, idOptions);
}

function validateOptionRecompensaCanjes() {

}

function validateNumComprobanteInputNoEmpty(recompensaCanjesInput) {
    if(!numComprobanteCanjesInput.value) {
        recompensaCanjesInput.value = '';
        showHideTooltip(codigoClienteTooltip, "Seleccione tipo de documento primero");
    }
}

function returnPuntosActualesDBWithRequestedTecnicoID(idTecnico, tecnicosDB) {
    for (const key in tecnicosDB) {
        if (tecnicosDB[key]["idTecnico"] === idTecnico) {
            return tecnicosDB[key]["totalPuntosActuales_Tecnico"];
        }
    }
    return null; 
}

async function filterNumComprobantesInputWithTecnico(idTecnico) {
    const url = `/dashboard-canjes/tecnico/${idTecnico}`;

    try {
        const response = await fetch(url);
        console.log("Fetching URL:", url);
        console.log('Response Status:', response.status);
        console.log('Response Headers:', response.headers.get('Content-Type'));

        if (!response.ok) {
            throw new Error(await response.text());
        }

        const comprobantes = await response.json();
        console.log('Comprobantes:', comprobantes);

        const comprobanteOptions = document.getElementById('comprobanteOptions');
        comprobanteOptions.innerHTML = '';

        comprobantes.forEach(comprobante => {
            const li = document.createElement('li');
            li.textContent = `${comprobante.idVentaIntermediada} - ${comprobante.codigoCliente_VentaIntermediada}`;
            li.onclick = function() {
                selectOptionNumComprobanteCanjes(`${comprobante.idVentaIntermediada}`, 'comprobanteCanjesInput', 'comprobanteOptions');
            };
            comprobanteOptions.appendChild(li);
        });
    } catch (error) {
        console.error('Error al obtener los comprobantes:', error.message);
        // Aquí puedes añadir código para mostrar el error al usuario
    }
}
    
