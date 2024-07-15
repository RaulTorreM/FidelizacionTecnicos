<div id="modalAgregarVenta" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Venta Intermediada</h5>
                <button class="close" onclick="closeModal('modalAgregarVenta')">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar nueva venta -->
                <form id="formAgregarVenta" action="{{ route('ventasIntermediadas.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label id="tecnico">Técnico <a>[+ Nuevo]</a></label>
                    </div>
                    <div class="input-select" id="tecnicoSelect">
                        <input type="text" id="tecnicoInput" placeholder="Ingresar técnico"
                               oninput="filterOptions()" onclick="toggleOptions('tecnicoOptions')" autocomplete="off">
                        <ul class="select-items" id="tecnicoOptions" style="display: none;">
                            @foreach ($tecnicos as $tecnico)
                              <li onclick="selectOption('{{ $tecnico->idTecnico }} - {{ $tecnico->nombreTecnico }}')">
                                {{ $tecnico->idTecnico }} - {{ $tecnico->nombreTecnico }}
                              </li>
                            @endforeach
                        </ul>
                    </div>
                </form>

                <!-- Seleccionar archivos -->
                <div class="select-files-div">
                    <div class="fileArea" id="fileArea" class="select-files-div" ondragover="allowDrop(event)">
                        <input type="file" id="fileInput" class="file-input" accept=".xml">
                        <button type="button" class="btnSelectFile" onclick="handleFileSelect()">Seleccionar archivo .xml</button>
                        <br>
                        <span>o arrastra y suelta aquí</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalAgregarVenta')">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarVenta('modalAgregarVenta')">Guardar</button>
            </div>
        </div>
    </div>
</div>

