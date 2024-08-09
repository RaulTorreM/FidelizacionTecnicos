<div id="modalAgregarVenta" class="modal">
    <div class="modal-dialog" id="modalAgregarVenta-dialog">
        <div class="modal-content" id="modalAgregarVenta-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Venta Intermediada</h5>
                <button class="close" onclick="closeModal('modalAgregarVenta')">&times;</button>
            </div>
            <div class="modal-body" id="idModalBodyAgregarVenta">
                <!-- Formulario para agregar nueva venta -->
                <form id="formAgregarVenta" action="{{ route('ventasIntermediadas.store') }}" method="POST">
                    @csrf

                    <!-- Campos ocultos para el formulario -->
                   
                    <input type="hidden" id="tecnicoId" name="idTecnico">
                    <input type="hidden" id="tecnicoNombre" name="nombreTecnico">
                   
                    <div class="form-group">
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
                            <input class="input-select-item" type="text" id="tecnicoInput" placeholder="DNI - Nombre"
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
                    <div class="form-group start">
                        <label class="primary-label" id="labelClienteAgregarVenta"> Cliente </label>
                    </div>

                    <div class="form-group gap">
                        <label class="secondary-label"> Tipo de documento </label>
                        <input class="input-item" id="tipoCodigoCliente" name="tipoCodigoCliente_VentaIntermediada"
                               oninput="validateRealTimeInputLength(this, 3)" readonly>
                        <label class="secondary-label"> # Documento </label>
                        <input class="input-item" id="clienteId" name="codigoCliente_VentaIntermediada"
                               oninput="validateRealTimeInputLength(this, 11)">
                        <label class="secondary-label"> Nombre </label>
                        <input class="input-item" id="clienteNombre" name="nombreCliente_VentaIntermediada"
                               oninput="validateRealTimeInputLength(this, 60)">
                    </div>  

                    <div class="form-group start">
                        <label class="primary-label" id="labelVentaAgregarVenta"> Venta </label>
                    </div>

                    <div class="form-group gap">
                        <label class="secondary-label"> Número de comprobante </label>
                        <input class="input-item" id="ventaIntermediadaId" name="idVentaIntermediada">
                        <label class="secondary-label"> Fecha y hora de emisión </label>
                        <input class="input-item" id="fechaHoraEmisionVentaIntermediada" name="fechaHoraEmision_VentaIntermediada">
                        <label class="secondary-label"> Monto total </label>
                        <input class="input-item" id="montoTotal" name="montoTotal_VentaIntermediada">
                    </div>
                    
                    <div class="form-group start">
                        <label class="important-label"> Puntos generados </label>
                    </div>
                    
                    <div class="form-group gap">
                        <input class="input-item" id="puntosGanadosInput" name="puntosGanados_VentaIntermediada">
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


