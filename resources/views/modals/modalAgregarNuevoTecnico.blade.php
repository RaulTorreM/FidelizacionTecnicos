<div id="modalAgregarNuevoTecnico" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar nuevo técnico</h5>
                <button class="close" onclick="closeModal('modalAgregarNuevoTecnico')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formAgregarNuevoTecnico" action="{{ route('ventasIntermediadas.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label id="dniLabel">DNI:</label>
                        <input type="text" id="dniInput" placeholder="Ingresar DNI">
                        <label id="name">Nombre:</label>
                        <input type="text" id="nameInput" placeholder="Ingresar nombre">
                    </div>
                    <div class="form-group">
                        <label id="phoneLabel">Celular:</label>
                        <input type="number" id="phoneInput" placeholder="Ingresar celular">
                        <div class="input-select" id="oficioSelect">
                            <label id="oficioLabel">Oficio:</label>
                            <input type="text" id="oficioInput" placeholder="Ingresar oficio"
                                   oninput="filterOptions()" onclick="toggleOptions('oficioOptions')" autocomplete="off">
                            <ul class="select-items" id="oficioOptions" style="display: none;">
                                <li>
                                    Albañil
                                </li>
                                <li>
                                    Enchapador
                                </li>
                                <li>
                                    Enchapador/Albañil
                                </li>
                                <li>
                                    Otro (ejemplo)
                                </li>
                            </ul>
                        </div>
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

