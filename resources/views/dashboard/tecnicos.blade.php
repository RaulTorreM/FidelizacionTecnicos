@extends('layouts.layoutDashboard')

@section('title', 'Técnicos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tecnicosStyle.css') }}">
	<link rel="stylesheet" href="{{ asset('css/modalAgregarNuevoTecnico.css') }}">
@endpush

@section('main-content')
	<div class="tecnicosContainer">
		<div class="firstRow">
			<x-btn-create-item onclick="openModal('modalAgregarNuevoTecnico')"> 
				Registrar nuevo técnico
			</x-btn-create-item>

			@include('modals.tecnicos.modalAgregarNuevoTecnico')

			<x-btn-edit-item onclick="openModal('modalEditarTecnico')"> Editar </x-btn-edit-item>


			<x-btn-delete-item onclick="openModal('modalEliminarTecnico')"> Eliminar </x-btn-delete-item>

		</div>
		
		<x-modalSuccessAction 
			:idSuccesModal="'successModalTecnicoGuardado'"
			:message="'Técnico guardado correctamente'"
		/>
		
		<x-modalSuccessAction 
			:idSuccesModal="'successModalTecnicoActualizado'"
			:message="'Téncico actualizado correctamente'"
		/>

		<x-modalSuccessAction 
			:idSuccesModal="'successModalTecnicoEliminado'"
			:message="'Técnico eliminado correctamente'"
		/>

		<!--Tabla de ventas intermediadas-->
		<div class="secondRow">
			<table id="tblTecnicos">
				<thead>
					<tr>
						<th class="celda-centered">#</th>
						<th class="celda-centered">DNI</th>
						<th>Nombre</th>
						<th class="celda-centered">Oficio</th>
						<th class="celda-centered">Celular</th>
						<th class="celda-centered">Fecha de nacimiento</th>
						<th class="celda-centered">Puntos actuales</th> 
						<th class="celda-centered">Histórico de puntos</th> 
						<th class="celda-centered">Rango</th> 
					</tr>
				</thead>
				<tbody>
					@php
						$contador = 1;
					@endphp
					
					@foreach ($tecnicos as $tecnico)
					<tr>
						<td class="celda-centered">{{ $contador++ }}</td> 
						<td class="celda-centered">{{ $tecnico->idTecnico }}</td>
						<td>{{ $tecnico->nombreTecnico }}</td>
						<td class="celda-centered">{{ $tecnico->oficioTecnico }}</td>
						<td class="celda-centered">{{ $tecnico->celularTecnico }}</td>
						<td class="celda-centered">{{ $tecnico->fechaNacimiento_Tecnico}}</td>
						<td class="celda-centered">{{ $tecnico->totalPuntosActuales_Tecnico}}</td>
						<td class="celda-centered">{{ $tecnico->historicoPuntos_Tecnico}}</td>
						<td class="celda__rangoTecnico">
							<span class="rangoTecnico__span-{{strtolower(str_replace(' ', '-', $tecnico->rangoTecnico))}}">
								{{ $tecnico->rangoTecnico }}
							</span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ asset('js/modalAgregarNuevoTecnico.js') }}"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			@if(session('successTecnicoStore'))
				console.log("FUNCIONA");
				openModal('successModalTecnicoGuardado');
			@endif
			@if(session('successUpdate'))
				openModal('successModalTecnicoActualizado');
			@endif
			@if(session('successDelete'))
				openModal('successModalTecnicoEliminado');
			@endif
		});
	</script>
@endpush