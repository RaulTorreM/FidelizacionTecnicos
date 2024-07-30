<div id="modalAgregarVenta" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Venta Intermediada</h5>
                <button class="close" onclick="closeModal('modalAgregarVenta')">&times;</button>
            </div>
            <div class="modal-body" id="idModalBodyAgregarVenta">
                <!-- Formulario para agregar nueva venta -->
                <form id="formAgregarVenta" action="{{ route('ventasIntermediadas.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="primary-label" id="idLabelTecnico">
                            Técnico 
                            <a onclick="openModal('modalAgregarNuevoTecnico')">[+ Nuevo]</a>
                        </label>
                    </div>
                    <div class="input-select" id="tecnicoSelect">
                        @php
                            $idInput = 'tecnicoInput';
                            $idOptions = 'tecnicoOptions';
                        @endphp
                        <input class="input-select-item" type="text" id="tecnicoInput" placeholder="Ingresar técnico"
                               oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}')" onclick="toggleOptions('{{ $idOptions }}')" autocomplete="off">
                        <ul class="select-items" id="tecnicoOptions">
                            @foreach ($tecnicos as $tecnico)
                                @php
                                    $value = $tecnico->idTecnico . " - " . $tecnico->nombreTecnico;
                                @endphp
                                <li onclick="selectOption('{{ $value }}', '{{ $idInput }}', '{{ $idOptions }}')">
                                    {{ $value }}
                                </li>
                            @endforeach
                        </ul>
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
                        onclick="guardarModal('modalAgregarVenta', 'formAgregarVenta')">Guardar</button>
            </div>
        </div>
    </div>
</div>

