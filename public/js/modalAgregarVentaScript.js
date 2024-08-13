let ventaIntermediadaObject = {};
let idVentaIntermediadaInput = document.getElementById('idVentaIntermediadaInput');
let idTecnicoInput = document.getElementById('idTecnicoInput');
let nombreTecnicoInput = document.getElementById('nombreTecnicoInput');
let tipoCodigoClienteInput = document.getElementById('tipoCodigoClienteInput');
let codigoClienteInput = document.getElementById('idClienteInput');
let nombreClienteInput = document.getElementById('nombreClienteInput');
let fechaHoraEmisionInput = document.getElementById('fechaHoraEmisionVentaIntermediadaInput');
let montoTotalInput = document.getElementById('montoTotalInput');
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

let tecnicoTooltip = document.getElementById('idTecnicoTooltip');
let codigoClienteTooltip = document.getElementById('idCodigoClienteTooltip');
let numComprobanteTooltip = document.getElementById('idNumComprobanteTooltip');
let fechaHoraEmisionTooltip = document.getElementById('fechaHoraEmisionTooltip');
let fechaEmisionTooltip = document.getElementById('idFechaEmisionTooltip');
let horaEmisionTooltip = document.getElementById('idHoraEmisionTooltip');
let multiMessageError2 = document.getElementById('multiMessageError2');

function selectOptionAgregarVenta(value, idInput, idOptions) {
    //Colocar en el input la opción seleccionada 
    selectOption(value, idInput, idOptions); 

    // Extraer id y nombre del valor
    const [id, nombre] = value.split(' - ');
    
    // Actualizar los campos ocultos
    if (id && nombre) {
        idTecnicoInput.value = id;
        nombreTecnicoInput.value = nombre;
    } else {
        idTecnicoInput.value = "";
        nombreTecnicoInput.value = "";
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
        idTecnicoInput.value = "";
        nombreTecnicoInput.value = "";
    } else {
        if (!tecnicoEncontrado) {
            console.log("No se encontró el técnico buscado");
            nuevaVentaMessageError.classList.add('shown'); 
            
            idTecnicoInput.value = "";
            nombreTecnicoInput.value = "";
        } else {
            console.log("Sí se encontró el técnico buscado");
            nuevaVentaMessageError.classList.remove('shown'); 

            // Actualizar los inputs ocultos
            if (id && nombre) {
                idTecnicoInput.value = id;
                nombreTecnicoInput.value = nombre;
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
        /*Object.entries(ventaIntermediadaObject).forEach(([key, value]) => {
            console.log(`${key}: ${value}`);
        });*/

        if (!idTecnicoInput.value.trim() || !nombreTecnicoInput.value.trim()) {
            //console.log("Tiene que rellenar el campo Técnico primero");
            showHideTooltip(tecnicoTooltip, "Tiene que rellenar el campo Técnico primero");
            clearSomeHiddenInputs();
        } else {
            multiMessageError2.classList.remove("shown");
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

function limitSpecificCharacters(input, characterLimits) {
    const originalValue = input.value;
    const cursorPos = input.selectionStart;
    let newValue = '';
    let charCounts = {};

    // Inicializar los contadores de caracteres
    for (const char in characterLimits) {
        charCounts[char] = 0;
    }

    // Iterar sobre cada carácter en el valor de entrada
    for (let i = 0; i < originalValue.length; i++) {
        const char = originalValue[i];

        if (char in characterLimits) {
            if (charCounts[char] < characterLimits[char]) {
                newValue += char;
                charCounts[char]++;
            }
        } else {
            newValue += char;
        }
    }

    // Actualizar el valor del input solo si ha cambiado
    if (newValue !== originalValue) {
        input.value = newValue;

        // Calcular la nueva posición del cursor
        const maxNewCursorPosition = Math.min(newValue.length, cursorPos);
        
        // Mover el cursor a la posición anterior o la más cercana posible
        if (originalValue.length !== cursorPos) {
            input.setSelectionRange(maxNewCursorPosition - 1, maxNewCursorPosition - 1);
        } else {
            input.setSelectionRange(maxNewCursorPosition, maxNewCursorPosition);
        }
    }
}

function keepWantedCharacters(input, charactersArray) {
    // Obtener el valor del input y la posición del cursor actual
    const value = input.value;
    const valueLength = input.value.length;
    const cursorPos = input.selectionStart; // Posición del cursor antes del filtrado

    // Crear una expresión regular que coincida con los caracteres no deseados
    const escapedCharacters = charactersArray.map(char => char.replace(/[-[\]/{}()*+?.\\^$|]/g, '\\$&')).join('');
    const regex = new RegExp(`[^${escapedCharacters}]`, 'g'); // Coincide con caracteres NO deseados

    // Eliminar todos los caracteres no deseados
    let newValue = value.replace(regex, '');

    // Actualizar el campo de entrada con el valor filtrado
    if (newValue !== value) {
        input.value = newValue;
        const newCursorPos = cursorPos;

        // Verificar que la nueva posición del cursor no exceda la longitud del nuevo valor
        const maxNewCursorPosition = Math.min(newValue.length, newCursorPos);
        
        // Mover el cursor a la posición anterior o la más cercana posible
        if (valueLength !== cursorPos) {
            input.setSelectionRange(maxNewCursorPosition-1, maxNewCursorPosition-1);
        } else {
            input.setSelectionRange(maxNewCursorPosition, maxNewCursorPosition);
        }
    }   
}


/*
function validateDateTimeManualInput(dateTimeInput) {
    let dateTimeValue = dateTimeInput.value;
    console.log("Valor original:", dateTimeValue);

    // Expresión regular para el formato aaaa-mm-dd hh:mm:ss
    const regex = /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/;

    // Verificar si el valor tiene el formato correcto
    if (dateTimeValue.length >= 19) {
        if (regex.test(dateTimeValue)) {
            const [, year, month, day, hour, minute, second] = dateTimeValue.match(regex);

            // Convertir a números
            const yearNum = parseInt(year, 10);
            const monthNum = parseInt(month, 10);
            const dayNum = parseInt(day, 10);
            const hourNum = parseInt(hour, 10);
            const minuteNum = parseInt(minute, 10);
            const secondNum = parseInt(second, 10);

            // Validar rangos
            if (yearNum >= 1900 && yearNum <= 2100 &&
                monthNum >= 1 && monthNum <= 12 &&
                hourNum >= 0 && hourNum <= 23 &&
                minuteNum >= 0 && minuteNum <= 59 &&
                secondNum >= 0 && secondNum <= 59) {

                // Validar días del mes
                const daysInMonth = new Date(yearNum, monthNum, 0).getDate();
                if (dayNum >= 1 && dayNum <= daysInMonth) {
                    console.log("Fecha y hora válidas");
                    return true;
                }
            }
        }
        // Limpiar el input si es inválido
        dateTimeInput.value = ''; 
        showHideTooltip(fechaHoraEmisionTooltip, "Fecha y hora inválidas");
    }
}*/

function validateNumComprobanteInput(numComprobanteInput) {
    // Convertir el valor del campo de entrada a mayúsculas
    numComprobanteInput.value = numComprobanteInput.value.toUpperCase();

    // Definir los caracteres permitidos y sus límites
    const wantedCharacters = ['B', 'F', '-', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    const characterLimits = {
        'B': 1,
        'F': 1,
        '-': 1,
    };

    // Filtrar los caracteres permitidos y limitar los caracteres según el objeto characterLimits
    keepWantedCharacters(numComprobanteInput, wantedCharacters);
    limitSpecificCharacters(numComprobanteInput, characterLimits);

    // Expresión regular mejorada para validar el formato F001-00000096 o B001-00000096
    const regex = /^[BF]\d{3}-\d{8}$/;
    const value = numComprobanteInput.value.trim();

    // Verificar si el valor coincide con el formato
    if (!regex.test(value)) {
        console.log('Número de comprobante inválido. Debe seguir la forma: F001-00000096 ó B001-00000096');
        showHideTooltip(numComprobanteTooltip, "Número de comprobante inválido. Debe seguir la forma: F001-00000096 ó B001-00000096");
        return;
    }

    console.log('Número de comprobante válido');
    showHideTooltip(numComprobanteTooltip, "Número de comprobante válido");
}

function validateManualDateInput(dateInput) {
    const wantedCharacters = ['-', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    const characterLimits = {
        '-': 2,
    };

    keepWantedCharacters(dateInput, wantedCharacters)
    limitSpecificCharacters(dateInput, characterLimits)

    // Expresión regular para validar el formato AAAA-MM-DD
    const dateFormatRegex = /^(\d{4})-(\d{2})-(\d{2})$/;
    const value = dateInput.value.trim();

    // Verificar que el primer carácter del año, mes y día no sea 0
    if (value.startsWith('0')) {
        console.log('El primer carácter no puede ser 0.');
        showHideTooltip(fechaEmisionTooltip, "El primer carácter no puede ser 0.");
        return;
    }

    // Extraer año, mes y día de la fecha
    const match = value.match(dateFormatRegex);
    if (!match) {
        console.log('Formato de fecha inválido.');
        showHideTooltip(fechaEmisionTooltip, "Formato de fecha inválido. Debe ser AAAA-MM-DD.");
        return;
    }
    
    const [_, year, month, day] = match;

    // Crear un objeto Date con el año, mes y día
    const inputDate = new Date(year, month - 1, day);
    const now = new Date();
    now.setHours(0, 0, 0, 0); // Ajustar la hora de la fecha actual para que sea medianoche

    // Verificar si la fecha es válida
    if (
        inputDate.getFullYear() === parseInt(year, 10) &&
        inputDate.getMonth() === parseInt(month, 10) - 1 && //Enero 0, Febrero 1, etc.
        inputDate.getDate() === parseInt(day, 10)
    ) {
        // Verificar si la fecha no es mayor que la fecha actual
        if (inputDate > now) {
            console.log('La fecha no puede ser mayor que la fecha actual.');
            showHideTooltip(fechaEmisionTooltip, "La fecha no puede ser mayor que la fecha actual.");
            return;
        } 
    } else {
        console.log('Fecha inválida según calendario.');
        showHideTooltip(fechaEmisionTooltip, "Fecha inválida según calendario.");
        return;
    }

    showHideTooltip(fechaEmisionTooltip, "Fecha válida.");
}

function validateManualTimeInput(timeInput) {
    const wantedCharacters = [':', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    keepWantedCharacters(timeInput, wantedCharacters)
    const characterLimits = {
        ':': 2,
    };

    limitSpecificCharacters(timeInput, characterLimits)

    // Expresión regular para validar el formato hh-mm-ss
    const regex = /^(\d{2}):(\d{2}):(\d{2})$/;
    const value = timeInput.value.trim();  
    
    // Verificar si el valor coincide con el formato
    if (!regex.test(value)) {
        console.log('Formato de hora inválido. Debe ser hh:mm:ss.');
        showHideTooltip(horaEmisionTooltip, "Formato de hora inválido. Debe ser hh:mm:ss");
        return;
    } 

    // Verificar los límites de horas, minutos y segundos
    // Extraer horas, minutos y segundos
    const [_, hours, minutes, seconds] = value.match(regex);

    // Convertir a números
    const hour = parseInt(hours, 10);
    const minute = parseInt(minutes, 10);
    const second = parseInt(seconds, 10);

    // Verificar límites de horas, minutos y segundos
    if (hour < 0 || hour > 23) {
        console.log('Las horas deben estar entre 00 y 23.');
        showHideTooltip(horaEmisionTooltip, "La horas deben estar entre 00 y 23.");
        return;
    }
    if (minute < 0 || minute > 59) {
        console.log('Los minutos deben estar entre 00 y 59.');
        showHideTooltip(horaEmisionTooltip, "Los minutos deben estar entre 00 y 59.");
        return;
    }
    if (second < 0 || second > 59) {
        console.log('Los segundos deben estar entre 00 y 59.');
        showHideTooltip(horaEmisionTooltip, "Los segundos deben estar entre 00 y 59.");
        return;
    }

    console.log('Formato de hora válido');
    showHideTooltip(horaEmisionTooltip,"Hora válida");
}

function validatePositiveFloat(input) {
    // Obtener el valor del input
    let value = input.value;
    
    // Eliminar todos los caracteres que no sean dígitos o punto decimal
    let newValue = value.replace(/[^\d.]/g, '');
    
    // Asegurar que solo haya un punto decimal
    let parts = newValue.split('.');
    if (parts.length > 2) {
        parts = [parts[0], parts.slice(1).join('')];
    }
    newValue = parts.join('.');
    
    // Limitar a dos decimales
    if (parts.length > 1) {
        parts[1] = parts[1].slice(0, 2);
        newValue = parts.join('.');
    }
    
    // Remover ceros iniciales innecesarios
    newValue = newValue.replace(/^0+(?=\d)/, '');
    
    // Si el valor es vacío o solo un punto, establecer a cero
    if (newValue === '' || newValue === '.') {
        newValue = '0';
    }
    
    // Actualizar el campo de entrada con el valor filtrado
    if (newValue !== value) {
        input.value = newValue;
        
        // Mover el cursor al final del input
        input.setSelectionRange(newValue.length, newValue.length);
    }
}

function validarCamposFormulario() {
    let allFilled = true;
    formInputsArray.forEach(input => {
        if (!input.value.trim()) {
            allFilled = false;
        }
    });
    return allFilled;
}

function updateDNIRUCMaxLength(numDocumentoClienteInput) {

    // Obtén el tipo de documento seleccionado
    const tipoDocumentoInput = document.getElementById('tipoCodigoClienteInput');
    const numDocumentoInput = numDocumentoClienteInput;

    // Verifica si los elementos se encontraron correctamente
    if (!tipoDocumentoInput || !numDocumentoInput) {
        console.error('No se encontraron los elementos con los IDs proporcionados.');
        return;
    }

    // Define los límites de longitud para cada tipo de documento
    const limites = {
        DNI: 8,
        RUC: 11
    };

    // Obtiene la longitud máxima correspondiente al tipo de documento seleccionado
    const tipoDocumento = tipoDocumentoInput.value.trim(); // Usa trim() para eliminar espacios en blanco
    const maxLength = limites[tipoDocumento] || null;

    // Establece el atributo maxlength o elimina el valor del input
    if (maxLength !== null) {
        numDocumentoInput.maxLength = maxLength;
    } else {
        numDocumentoInput.removeAttribute('maxlength'); // Elimina el atributo maxlength si no es válido
        numDocumentoInput.value = ''; // Vacía el valor del input
        showHideTooltip(codigoClienteTooltip, "Seleccione tipo de documento primero");
    }

    // Debugging
    console.log("Tipo de Documento:", tipoDocumento);
    console.log("Longitud Máxima:", maxLength);
}

function clearNumDocumento() {
    codigoClienteInput.value = "";
}



document.addEventListener('DOMContentLoaded', function() {

    function updatePuntosGanados() {
        // Copia el valor de "Monto total" al campo de "Puntos generados"
        puntosGanadosInput.value = Math.round(parseFloat(montoTotalInput.value));
    }
   
    // Agrega un listener para el evento "input" en "Monto total"
    montoTotalInput.addEventListener('input', updatePuntosGanados);
});

function guardarModalAgregarVenta(idModal, idForm) {
    if (validarCamposFormulario()) {
        console.log("Enviando formulario correctamente.")
        multiMessageError2.textContent = "Enviando formulario correctamente.";
        multiMessageError2.classList.remove("shown");
        //guardarModal(idModal, idForm);
    } else {
        console.log("Todos los campos del formulario deben estar rellenados correctamente.")
        multiMessageError2.textContent = "Todos los campos del formulario deben estar rellenados correctamente.";
        multiMessageError2.classList.add("shown");
    }
}