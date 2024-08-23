@extends('layouts.layoutDashboard')

@section('title', 'Técnicos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tecnicosStyle.css') }}">
@endpush

@section('main-content')
	<div class="tecnicosContainer">
		<div class="firstRow">
			<x-btn-create-item onclick=""> 
				Registrar nuevo técnico
			</x-btn-create-item>

			<x-btn-edit-item onclick=""> Editar </x-btn-edit-item>

			<x-btn-delete-item onclick=""> Eliminar </x-btn-delete-item>

		</div>
		
		<x-modalSuccessAction 
			:idSuccesModal="'successModalRecompensaGuardada'"
			:message="'Recompensa guardada correctamente'"
		/>

		<x-modalSuccessAction 
			:idSuccesModal="'successModalRecompensaActualizada'"
			:message="'Recompensa actualizada correctamente'"
		/>

		<x-modalSuccessAction 
			:idSuccesModal="'successModalRecompensaEliminada'"
			:message="'Recompensa eliminada correctamente'"
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
						<td class="celda-centered">{{ $tecnico->rangoTecnico}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection