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
					<div class="tooltip-container">
						<span class="tooltip" id="idTecnicoTooltip">Este es el mensaje del tooltip</span>
					</div>
					<input class="input-select-item" type="text" id='{{ $idInput }}' maxlength="50" placeholder="DNI - Nombre"
						oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}')" 
						onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')">
					<ul class="select-items" id='{{ $idOptions }}'>
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
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Puntos Actuales </label>
				<input class="input-item" id="puntosActualesCanjesInput" maxlength="4" 
					   placeholder="0" name="aa" disabled>
			</div>
		</div>

		<div class="thirdCanjesRow">
			<div class="verticalPairGroup">
				<label class="primary-label"> Número de comprobante </label>
				<x-onlySelect-input 
						:idSelect="'comprobanteSelect'"
						:inputClassName="'onlySelectInput'"
						:idInput="'comprobanteInput'"
						:idOptions="'comprobanteOptions'"
						:placeholder="'Seleccionar comprobante'"
						:name="'idVentaIntermediada'"
						:options="$optionsNumComprobante"
				/>
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Monto total </label>
				<input class="input-item" id="montoTotalCanjesInput" maxlength="4" 
					   placeholder="S/. 0" name="bbb" disabled>
			</div>
		</div>

	</div>

@endsection

@push('scripts')
	<script src="{{ asset('js/canjes.js') }}"></script>
@endpush