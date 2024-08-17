<div class="modal first"  id="modalEditarRecompensa">
    <div class="modal-dialog" id="modalEditarRecompensa-dialog">
        <div class="modal-content" id="modalEditarRecompensa-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar recompensas</h5>
                <button class="close" onclick="closeModal('modalEditarRecompensa')">&times;</button>
            </div>
            <div class="modal-body" id="idModalBodyEditarRecompensa">
                <form id="formEditarRecompensa" action="{{ route('recompensas.edit') }}" method="POST">
                    @csrf

                    <input id="idRecompensaInput" maxlength="13" name="idRecompensa">

                    <div class="form-group gap">
                        <label class="primary-label" for="recompensaSelect">Recompensa:</label>
                        <div class="input-select" id="recompensaSelect">
                            @php
                                $idInput = 'recompensaInput';
                                $idOptions = 'recompensaOptions';
                            @endphp
                            <input class="input-select-item" type="text" id='{{ $idInput }}' maxlength="50" placeholder="Código - Descripción"
                                oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}'),
                                            validateValueOnRealTime(this)" 
                                onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')">
                            <ul class="select-items" id='{{ $idOptions }}'>
                                @foreach ($recompensasWithoutFirst as $recompensa)
                                    @php
                                        $value = $recompensa->idRecompensa . " - " . $recompensa->descripcionRecompensa;
                                    @endphp
                                    <li onclick="selectOptionEditarRecompensa('{{ $value }}', '{{ $idInput }}', '{{ $idOptions }}')">
                                        {{ $value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <span class="inline-alert-message" id="editarRecompensaMessageError"> No se encontró la recompensa buscada </span>      
                    </div>

                    <div class="form-group gap">
                        <label class="primary-label" id="tipoRecompensaLabelEdit" for="tipoRecompensaInput">Tipo:</label>
                        <x-onlySelect-input 
                            :idInput="'tipoRecompensaInputEdit'"
                            :inputClassName="'onlySelectInput long'"
                            :placeholder="'Seleccionar tipo de recompensa'"
                            :name="'tipoRecompensa'"
                            :options="['Accesorio', 'EPP', 'Herramienta']"
                            :disabled="true"
                        />
                    </div>

                    <div class="form-group gap">
                        <label class="primary-label" for="idRecompensaDescripcion">Descripción:</label>
                        <textarea class="textarea normal" id="descripcionRecompensaInputEdit" name="descripcionRecompensa" 
                                  placeholder="Breve descripción" disabled></textarea>
                    </div>
                
                    <div class="form-group gap">
                        <label class="primary-label" for="costoUnitarioInput">Costo unitario (puntos):</label>
                        <input class="input-item" name="costoPuntos_Recompensa" maxlength="4"
                                   oninput="validateNumberRealTime(this)" placeholder="1000">
                    </div>

                    <div class="form-group start">
                        <span class="inline-alert-message"> multiMessageError </span>      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEditarRecompensa')">Cancelar</button>
                <button type="button" class="btn btn-primary" 
                        onclick="guardarModalRegistrarNuevaRecompensa('modalEditarRecompensa', 'formEditarRecompensa')">Guardar</button>
            </div>
        </div>
    </div>
</div>

