let ventaIntermediadaObject = {};
let idVentaIntermediadaInput = document.getElementById('ventaIntermediadaId');
let idTecnicoInput = document.getElementById('tecnicoId');
let nombreTecnicoInput = document.getElementById('tecnicoNombre');
let tipoCodigoClienteInput = document.getElementById('tipoCodigoCliente');
let codigoClienteInput = document.getElementById('clienteId');
let nombreClienteInput = document.getElementById('clienteNombre');
let fechaHoraEmisionInput = document.getElementById('fechaHoraEmisionVentaIntermediada');
let montoTotalInput = document.getElementById('montoTotal');
let puntosGanadosInput = document.getElementById('puntosGanadosInput');

let formInputsArray = [
    idVentaIntermediadaInput, 
    idTecnicoInput, 
    nombreTecnicoInput, 
    tipoCodigoClienteInput,
    codigoClienteInput,
    nombreClienteInput,
    fechaHoraEmisionInput,
    montoTotalInput,
    puntosGanadosInput,
];

function selectOptionAgregarVenta(value, idInput, idOptions) {
    //Colocar en el input la opción seleccionada 
    selectOption(value, idInput, idOptions); 

    // Extraer id y nombre del valor
    const [id, nombre] = value.split(' - ');
    
    // Actualizar los campos ocultos
    if (id && nombre) {
        document.getElementById('tecnicoId').value = id;
        document.getElementById('tecnicoNombre').value = nombre;
    } else {
        document.getElementById('tecnicoId').value = "";
        document.getElementById('tecnicoNombre').value = "";
    }

    var nuevaVentaMessageError = document.getElementById('nuevaVentaMessageError');
    nuevaVentaMessageError.classList.remove('shown'); 
}

function validateValueOnRealTime(input) {
    var nuevaVentaMessageError = document.getElementById('nuevaVentaMessageError');

    const value = input.value;
    
    // Obtener todos los valores de técnicos
    const allTecnicos = getAllIdNombreTecnicos();
    
    // Comparar el valor ingresado con la lista de técnicos
    const tecnicoEncontrado = allTecnicos.includes(value);

    const [id, nombre] = value.split(' - ');

    if (value === "") {
        console.log("El campo Técnico está vacío");
        nuevaVentaMessageError.classList.remove('shown'); 
    } else {
        if (!tecnicoEncontrado) {
            console.log("No se encontró el técnico buscado");
            nuevaVentaMessageError.classList.add('shown'); 
            
            document.getElementById('tecnicoId').value = "";
            document.getElementById('tecnicoNombre').value = "";
        } else {
            console.log("Sí se encontró el técnico buscado");
            nuevaVentaMessageError.classList.remove('shown'); 

            // Actualizar los inputs ocultos
            if (id && nombre) {
                document.getElementById('tecnicoId').value = id;
                document.getElementById('tecnicoNombre').value = nombre;
            } 
        }
    }
}

function getAllIdNombreTecnicos() {
    // Obtener el elemento UL que contiene todas las opciones
    const ul = document.getElementById('tecnicoOptions');
    
    // Obtener todos los elementos LI dentro de la UL
    const liElements = ul.getElementsByTagName('li');
    
    // Extraer el texto de cada LI y almacenarlo en un array
    let tecnicos = [];
    for (let li of liElements) {
        tecnicos.push(li.textContent.trim());
    }
    
    return tecnicos;
}

function analizarXML(file) {
    /*
    HACER PRUEBA UNITARIA PARA ESTA FUNCIÓN 
    */

    const reader = new FileReader();

    reader.onload = function(event) {
        const xmlText = event.target.result;

        // Parsear el contenido XML en un documento DOM
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlText, "application/xml");

        // Obtener valores
        const idVentaIntermediada = getElementText(xmlDoc, 'cbc', 'ID');

        const cliente = {
			codigoCliente: getElementText(xmlDoc, 'cbc', 'ID', 'cac:AccountingCustomerParty', 'cac:Party', 'cac:PartyIdentification'),
			nombreCliente: getElementText(xmlDoc, 'cbc', 'RegistrationName', 'cac:AccountingCustomerParty', 'cac:Party', 'cac:PartyLegalEntity')
		};

        const fechaHoraEmision = {
            fecha: getElementText(xmlDoc, 'cbc', 'IssueDate'),
            hora: getElementText(xmlDoc, 'cbc', 'IssueTime')
        };

        const montoTotal = getElementText(xmlDoc, 'cbc', 'PayableAmount');

        // Detectar tipo de código cliente
        const tipoCodigoCliente = detectarTipoCodigoCliente(cliente.codigoCliente);

		// Crear un array con los valores
        ventaIntermediadaObject = {
            idVentaIntermediada: idVentaIntermediada,
            tipoCodigoCliente: tipoCodigoCliente,
            clienteCodigo: cliente.codigoCliente,
            clienteNombre: cliente.nombreCliente,
            fechaEmision: fechaHoraEmision.fecha,
            horaEmision: fechaHoraEmision.hora,
            montoTotal: montoTotal,
            puntosGanados: Math.round(parseFloat(montoTotal)),
        }

		// Imprimir en consola usando Object.entries()
        Object.entries(ventaIntermediadaObject).forEach(([key, value]) => {
            console.log(`${key}: ${value}`);
        });

        if (!idTecnicoInput.value.trim() || !nombreTecnicoInput.value.trim()) {
            console.log("Tiene que rellenar los campos del técnico");
            clearSomeHiddenInputs();
        } else {
            console.log("Sí se rellenó los campos del técnico");
            fillSomeHiddenInputs(ventaIntermediadaObject);
        }
    };

    reader.onerror = function(event) {
        console.error('Error al leer el archivo:', event.target.error);
    };

    reader.readAsText(file);
}

function clearSomeHiddenInputs() {
    formInputsArray.forEach(input => {
        if (input) {
            input.value = "";
        }
    });
}

function fillSomeHiddenInputs(ventaIntermediadaObject) {
    idVentaIntermediadaInput.value = ventaIntermediadaObject.idVentaIntermediada || '';
    tipoCodigoClienteInput.value = ventaIntermediadaObject.tipoCodigoCliente || '';
    codigoClienteInput.value = ventaIntermediadaObject.clienteCodigo || '';
    nombreClienteInput.value = ventaIntermediadaObject.clienteNombre || '';
    fechaHoraEmisionInput.value = ventaIntermediadaObject.fechaEmision + " " + ventaIntermediadaObject.horaEmision || '';
    montoTotalInput.value = ventaIntermediadaObject.montoTotal || '';
    puntosGanadosInput.value = ventaIntermediadaObject.puntosGanados || ''; 
}

function getElementText(xmlDoc, prefix, tagName, ...path) {
    const namespaces = {
        cbc: 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2',
        cac: 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2'
    };

    let element = xmlDoc.documentElement;

    // Navegar a través de los elementos
    for (let step of path) {
        const stepPrefix = step.split(':')[0];
        const stepName = step.split(':')[1] || step;
        element = element.getElementsByTagNameNS(namespaces[stepPrefix] || '', stepName)[0];
        if (!element) {
            console.log(`No se encontró el elemento: ${step}`);
            return '';
        }
    }

    // Obtener el elemento final
    const finalElement = element.getElementsByTagNameNS(namespaces[prefix] || '', tagName)[0];
    if (!finalElement) {
        console.log(`No se encontró el elemento final: ${tagName}`);
        return '';
    }

    return finalElement.textContent.trim();
}

function detectarTipoCodigoCliente(codigoCliente) {
    return codigoCliente.length === 8 ? 'DNI' : codigoCliente.length === 11 ? 'RUC' : 'Desconocido';
}

function validarCamposFormulario() {
    let allFilled = true;
    formInputsArray.forEach(input => {
        if (!input.value.trim()) {
            allFilled = false;
            input.classList.add('error'); // Añadir una clase de error para mostrar un mensaje
        } else {
            input.classList.remove('error');
        }
    });
    return allFilled;
}

function guardarModalAgregarVenta(idModal, idForm) {
     // Validar campos antes de enviar
    if (validarCamposFormulario()) {
        // Si la validación es correcta, enviar el formulario
        //guardarModal(idModal, idForm);
        console.log("Enviando formulario correctamente.")
    } else {
        console.log("Todos los campos del formulario deben estar rellenados correctamente.")
    }
}