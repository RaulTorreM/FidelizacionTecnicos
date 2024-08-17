<div class="modal first"  id="modalRegistrarNuevaRecompensa">
    <div class="modal-dialog" id="modalRegistrarNuevaRecompensa-dialog">
        <div class="modal-content" id="modalRegistrarNuevaRecompensa-content">
            <div class="modal-header">
                <h5 class="modal-title">Registar nueva recompensa</h5>
                <button class="close" onclick="closeModal('formRegistrarNuevaRecompensa')">&times;</button>
            </div>
            <div class="modal-body" id="idModalBodyRegistrarNuevaRecompensa">
                <form id="formRegistrarNuevaRecompensa" action="{{ route('nuevaRecompensa.store') }}" method="POST">
                    @csrf

                    <div class="form-group gap">
                        <label class="primary-label" id="codigoRecompensaLabel" for="codigoRecompensaInput">Código de recompensa:</label>
                        <input class="input-item readonly" id="codigoRecompensaInput" name="idRecompensa" 
                               oninput="" maxlength="13" value="RECOM-001" readonly>
                    </div>
                    
                    <div class="form-group gap">
                        <label class="primary-label" id="tipoRecompensaLabel" for="tipoRecompensaInput">Tipo:</label>

                        <x-onlySelect-input 
                            :idSelect="'tipoRecompensaSelect'"
                            :inputClassName="'onlySelectInput long'"
                            :idInput="'tipoRecompensaInput'"
                            :idOptions="'tipoRecompensaOptions'"
                            :placeholder="'Seleccionar tipo de recompensa'"
                            :name="'tipoRecompensa'"
                            :options="['Accesorio', 'Efectivo', 'EPP', 'Herramienta']"
                        />
                    </div>

                    <div class="form-group gap">
                        <label class="primary-label" id="descripcionLabel" for="idRecompensaDescripcion">Descripción:</label>
                        <textarea id="idRecompensaDescripcion" name="descripcionRecompensa" placeholder="Ingresar una breve descripción"></textarea>
                    </div>
                
                    <div class="form-group gap">
                        <label class="primary-label" id="costoUnitarioLabel" for="costoUnitarioInput">CostoUnitario:</label>
                        <input class="input-item" id="costoUnitarioInput" name="costoPuntos_Recompensa" maxlength="4"
                                   oninput="validateNumberRealTime(this)" placeholder="1000">
                    </div>

                    <div class="form-group start">
                        <span class="inline-alert-message" id="multiMessageError"> multiMessageError </span>      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalRegistrarNuevaRecompensa')">Cancelar</button>
                <button type="button" class="btn btn-primary" 
                        onclick="guardarModalAgregarNuevoTecnico('modalRegistrarNuevaRecompensa', 'formRegistrarNuevaRecompensa')">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modalRegistrarNuevaRecompensa.js') }}"></script>
