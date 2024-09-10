@extends('layouts.layoutDashboard')

@section('title', 'Canjes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/canjesStyle.css') }}">
@endpush

@section('main-content')
	<div class="canjesContainer">
		 <!-- Variables globales -->
		 @php
			$idInput = 'tecnicoCanjesInput';
			$idOptions = 'tecnicoCanjesOptions';
			$idMessageError = "messageErrorTecnicoCanjes";
			$tecnicosDB = $tecnicos;
		@endphp

		<div class="firstCanjesRow">
			<h3>Registrar nuevo canje</h3>
			<div class="fechaContainer">
				<label class="secondary-label"> Fecha: </label>
				<input class="input-item" id ="idFechaCanjeInput" type="date" disabled>
			</div>
		</div>

		<div class="secondCanjesRow">
			<div class="verticalPairGroup">
				<label class="primary-label"> Técnico </label>
				<div class="input-select" id="tecnicoSelect">
					<input class="input-select-item" type="text" id='{{ $idInput }}' maxlength="50" placeholder="DNI - Nombre"
						oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}'),
								 validateOptionTecnicoCanjes(this, '{{ $idOptions }}', '{{ $idMessageError }}', {{ json_encode($tecnicosDB) }})"
						onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')">
					<ul class="select-items" id='{{ $idOptions }}'>
						@foreach ($tecnicosDB as $tecnico)
							@php
								$value = $tecnico->idTecnico . " - " . $tecnico->nombreTecnico;
								$puntosActuales = $tecnico->totalPuntosActuales_Tecnico;
							@endphp
							<li onclick="selectOptionTecnicoCanjes('{{ $value }}', '{{ $idInput }}', '{{ $idOptions }}', '{{ $puntosActuales }}')">
								{{ $value }}
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label noEditable"> Puntos Actuales </label>
				<input class="input-item" id="puntosActualesCanjesInput" maxlength="4" 
					   placeholder="0" name="aa" disabled>
			</div>
			<span class="inline-alert-message" id="{{ $idMessageError }}"> No se encontró el técnico buscado </span>      
		</div>

		<div class="thirdCanjesRow">
			<div class="verticalPairGroup tooltipInside">
				<label class="primary-label"> Número de comprobante </label>
				<div class="tooltip-container">
					<span class="tooltip" id="idTecnicoCanjesTooltip">Este es el mensaje del tooltip</span>
				</div>
				<x-onlySelect-input 
						:idSelect="'comprobanteSelect'"
						:inputClassName="'onlySelectInput'"
						:idInput="'comprobanteCanjesInput'"
						:idOptions="'comprobanteOptions'"
						:placeholder="'Seleccionar comprobante'"
						:name="'idVentaIntermediada'"
						:options="$optionsNumComprobante"
						:onSelectFunction="'selectOptionNumComprobanteCanjes'"
				/>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label noEditable"> Fecha Emisión </label>
				<input class="input-item" id ="fechaEmisionCanjesInput" type="date" disabled>
			</div>
			<div class="verticalPairGroup noEditable">
				<label class="primary-label noEditable"> Fecha Cargada </label>
				<input class="input-item" id ="fechaCargadaCanjesInput" type="date" disabled>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label noEditable"> Cliente  </label>
				<textarea class="textarea" id="clienteCanjesTextarea" 
						  type="text" disabled>GARCÍA BETANCOURT, Josué Daniel				DNI: 77043114
				</textarea>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label noEditable"> Monto total </label>
				<input class="input-item" id="montoTotalCanjesInput" maxlength="4" 
					   placeholder="S/. 0" name="bbb" disabled>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label noEditable"> Puntos generados </label>
				<input class="input-item" id="montoTotalCanjesInput" maxlength="4" 
					   placeholder="0" name="bbb" disabled>
			</div>
		</div>

	</div>

@endsection

@push('scripts')
	<script src="{{ asset('js/canjes.js') }}"></script>
@endpush