<div id="modalAgregarVenta" class="modal">
    <div class="modal-dialog" id="modalAgregarVenta-dialog">
        <div class="modal-content" id="modalAgregarVenta-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Venta Intermediada</h5>
                <button class="close" onclick="closeModal('modalAgregarVenta')">&times;</button>
            </div>
            <div class="modal-body" id="modalAgregarVenta-body">
                <!-- Formulario para agregar nueva venta -->
                <form id="formAgregarVenta" action="{{ route('ventasIntermediadas.store') }}" method="POST">
                    @csrf

                    <!-- Campos ocultos para el formulario -->
                   
                    <input type="hidden" id="idTecnicoInput" name="idTecnico">
                    <input type="hidden" id="nombreTecnicoInput" name="nombreTecnico">
                   
                    <div class="form-group marginTop">
                        <label class="primary-label" id="idLabelTecnico">
                            Técnico 
                            <a onclick="openModal('modalAgregarNuevoTecnico')">[+ Nuevo]</a>
                        </label>
                    </div>
                    <div class="form-group start">
                        <div class="input-select" id="tecnicoSelect">
                            @php
                                $idInput = 'tecnicoInput';
                                $idOptions = 'tecnicoOptions';
                            @endphp
                            <input class="input-select-item" type="text" id='{{ $idInput }}' placeholder="DNI - Nombre"
                                oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}'), validateRealTimeInputLength(this, 60),
                                            validateValueOnRealTime(this)" 
                                onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')">
                            <ul class="select-items" id="tecnicoOptions">
                                @foreach ($tecnicos as $tecnico)
                                    @php
                                        $value = $tecnico->idTecnico . " - " . $tecnico->nombreTecnico;
                                    @endphp
                                    <li onclick="selectOptionAgregarVenta('{{ $value }}', '{{ $idInput }}', '{{ $idOptions }}')">
                                        {{ $value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <span class="inline-alert-message" id="nuevaVentaMessageError"> No se encontró el técnico buscado </span>      
                    </div>
                    
                    <div class="form-group start marginTop">
                        <label class="primary-label" id="labelClienteAgregarVenta"> Cliente </label>
                    </div>

                    <div class="form-group gap">
                        <div class = "group-items">
                            <label class="secondary-label"> Tipo </label>
                           
                            <div class="input-select" id="tipoDocumentoSelect">
                                @php
                                    $idInput = 'tipoCodigoClienteInput';
                                    $idOptions = 'tipoDocumentoOptions';
                                @endphp
                               <div class="onlySelectInput-container">
                                    <input class="onlySelectInput" type="text" id='{{ $idInput }}' placeholder="DNI" readonly 
                                        oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}')" 
                                        onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')" autocomplete="off" name="tipoCodigoCliente_VentaIntermediada">
                                    <span class="material-symbols-outlined"
                                          onclick="clearInput('{{ $idInput }}')">cancel</span>
                                </div>
                                <ul class="select-items" id="tipoDocumentoOptions">
                                    <li onclick="selectOption('DNI', '{{ $idInput }}', '{{ $idOptions }}')">
                                        DNI
                                    </li>
                                    <li onclick="selectOption('RUC', '{{ $idInput }}', '{{ $idOptions }}')">
                                        RUC
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class = "group-items">
                            <label class="secondary-label"> Num. Documento </label>
                            <div class="tooltip-container">
                                <span class="tooltip" id="idCodigoClienteTooltip">Este es el mensaje del tooltip</span>
                            </div>
                            <input class="input-item" id="idClienteInput" name="codigoCliente_VentaIntermediada"
                                   oninput="validateRealTimeDNIRUCInputLength(this, '{{ $idInput }}'), validateNumberRealTime(this)" placeholder="12345678">
                        </div>
                        <div class = "group-items">
                            <label class="secondary-label"> Nombre </label>
                            <input class="input-item" id="nombreClienteInput" name="nombreCliente_VentaIntermediada"
                                   oninput="validateRealTimeInputLength(this, 60)" placeholder="CARRASCO GONZALES, MANUEL">
                        </div>
                    </div>  

                    <div class="form-group start marginTop">
                        <label class="primary-label" id="labelVentaAgregarVenta"> Venta </label>
                    </div>

                    <div class="form-group gap">
                        <div class = "group-items">
                            <label class="secondary-label"> Número de comprobante </label>
                            <input class="input-item" id="idVentaIntermediadaInput" name="idVentaIntermediada"
                                   placeholder="B001-72">
                        </div>
                        <div class = "group-items">
                            <label class="secondary-label"> Fecha y hora de emisión </label>
                            <div class="tooltip-container">
                                <span class="tooltip" id="fechaHoraEmisionTooltip">Este es el mensaje del tooltip</span>
                            </div>
                            <input class="input-item" id="fechaHoraEmisionVentaIntermediadaInput" type="text"
                                   oninput="validateDateTimeManualInput(this)" name="fechaHoraEmision_VentaIntermediada"
                                   placeholder="aaaa-mm-dd hh:mm:ss">
                        </div>
                        <div class="group-items">
                            <label class="secondary-label">Monto total</label>
                            <input class="input-item" id="montoTotalInput" name="montoTotal_VentaIntermediada" type="text" 
                                   oninput="validateRealTimeInputLength(this, 10), validatePositiveFloat(this)" 
                                   placeholder="25.50">
                        </div>
                    </div>
                    
                    <div class="form-group start marginTop">
                        <label class="important-label"> Puntos generados </label>
                    </div>
                    
                    <div class="form-group start">
                        <input class="input-item" id="puntosGanadosInput" name="puntosGanados_VentaIntermediada"  placeholder="26" readonly>
                        <span class="inline-alert-message" id="multiMessageError2"> multiMessageError2 </span> 
                    </div>
                </form>
                <!-- Seleccionar archivos -->
                <div class="select-files-div" id="idSelectFilesContainer">
                    <div class="fileArea" id="fileArea" class="select-files-div" ondragover="allowDrop(event)"
                         ondragleave="removeDrop(event)" ondrop="handleDrop(event)">
                         <div class="fileArea_text">
                            <input type="file" id="fileInput" class="file-input" accept=".xml">
                            <button type="button" class="btnSelectFile" onclick="handleFileSelect()">Seleccionar archivo .xml</button>
                            <span>o arrastra y suelta aquí</span>
                         </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalAgregarVenta')">Cancelar</button>
                <button type="button" class="btn btn-primary"
                        onclick="guardarModalAgregarVenta('modalAgregarVenta', 'formAgregarVenta')">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modalAgregarVentaScript.js') }}"></script>


