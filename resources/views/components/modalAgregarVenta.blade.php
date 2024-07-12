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
                              </li>git 
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalAgregarVenta')">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarVenta()">Guardar</button>
            </div>
        </div>
    </div>
</div>

