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

                    <label class="primary-label" id="dniLabel" for="dniInput">Num recompensa:</label>
                    <input class="input-item" type="number" id="dniInput" placeholder="12345678" 
                            oninput="validateRealTimeInputLength(this, 8), validateNumberRealTime(this)" name="idTecnico">
                    <label class="primary-label" id="nameLabel"  for="nameInput">Nombre:</label>
                    <input class="input-item" type="text" id="nameInput" placeholder="Ingresar nombre" name="nombreTecnico"
                            oninput="validateRealTimeInputLength(this, 60)">
                      
                    <label class="primary-label" id="phoneLabel" for="phoneInput">Celular:</label>
                    <input class="input-item" type="number" id="phoneInput" placeholder="999888777"
                            oninput="validateRealTimeInputLength(this, 9), validateNumberRealTime(this)" name="celularTecnico">
                    <label class="primary-label" id="oficioLabel" for="oficioInput">Oficio:</label>
                    <div class="input-select" id="oficioSelect">
                        @php
                            $idInput = 'oficioInput';
                            $idOptions = 'oficioOptions';
                        @endphp
                        <div class="onlySelectInput-container">
                            <input class="onlySelectInput" type="text" id="oficioInput" placeholder="Seleccionar oficio" readonly 
                                oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}')" 
                                onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')" autocomplete="off" name="oficioTecnico">
                            <span class="material-symbols-outlined"
                                    onclick="clearInput('{{ $idInput }}')">cancel</span>
                        </div>
                        <ul class="select-items" id="oficioOptions">
                            <li onclick="selectOption('Albañil', '{{ $idInput }}', '{{ $idOptions }}')">
                                Albañil
                            </li>
                            <li onclick="selectOption('Enchapador', '{{ $idInput }}', '{{ $idOptions }}')">
                                Enchapador
                            </li>
                            <li onclick="selectOption('Enchapador/Albañil', '{{ $idInput }}', '{{ $idOptions }}')">
                                Enchapador/Albañil
                            </li>
                        </ul>
                    </div>
                   
                    <label class="primary-label" id="bornDateLabel" for="bornDateInput">Fecha de nacimiento:</label>
                    <input class="input-item" type="date" id="bornDateInput"
                            placeholder="Ingresar fecha de nacimiento" name="fechaNacimiento_Tecnico">
                    <span class="inline-alert-message" id="dateMessageError"> dateMessageError </span>      
                
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
