<div class="modal second" id="modalAgregarNuevoTecnico">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar nuevo técnico</h5>
                <button class="close" onclick="closeModal('modalAgregarNuevoTecnico')">&times;</button>
            </div>
            <div class="modal-body" id="idModalBodyAgregarNuevoTecnico">
                <form id="formAgregarNuevoTecnico" action="{{ route('nuevoTecnico.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="primary-label marginX" id="dniLabel" for="dniInput">DNI:</label>
                        <input class="input-item" type="number" id="dniInput" placeholder="12345678" 
                               oninput="validateRealTimeInputLength(this, 8), validateNumberRealTime(this)" name="idTecnico">
                        <label class="primary-label marginX" id="nameLabel"  for="nameInput">Nombre:</label>
                        <input class="input-item" type="text" id="nameInput" placeholder="Ingresar nombre" name="nombreTecnico"
                               oninput="validateRealTimeInputLength(this, 60)">
                    </div>
                    <div class="form-group">
                        <label class="primary-label marginX" id="phoneLabel" for="phoneInput">Celular:</label>
                        <input class="input-item" type="number" id="phoneInput" placeholder="999888777"
                               oninput="validateRealTimeInputLength(this, 9), validateNumberRealTime(this)" name="celularTecnico">
                        <label class="primary-label marginX" id="oficioLabel" for="oficioInput">Oficio:</label>
                        <x-onlySelect-input 
                            :idSelect="'oficioSelect'"
                            :inputClassName="'onlySelectInput'"
                            :idInput="'oficioInput'"
                            :idOptions="'oficioOptions'"
                            :placeholder="'Seleccionar oficio'"
                            :name="'oficioTecnico'"
                            :options="['Albañil', 'Enchapador', 'Enchapador/Albañil']"
                            />
                    </div>

                    <div class="form-group start">
                        <label class="primary-label marginX" id="bornDateLabel" for="bornDateInput">Fecha de nacimiento:</label>
                        <input class="input-item" type="date" id="bornDateInput"
                               placeholder="Ingresar fecha de nacimiento" name="fechaNacimiento_Tecnico">
                        <span class="inline-alert-message" id="dateMessageError"> dateMessageError </span>      
                    </div>
                    
                    <div class="form-group start">
                        <span class="inline-alert-message" id="multiMessageError"> multiMessageError </span>      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalAgregarNuevoTecnico')">Cancelar</button>
                <button type="button" class="btn btn-primary" 
                        onclick="guardarModalAgregarNuevoTecnico('modalAgregarNuevoTecnico', 'formAgregarNuevoTecnico')">Guardar</button>
            </div>
        </div>
    </div>
</div>

