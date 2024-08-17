@extends('layouts.layoutDashboard')

@section('title', 'Recompensas')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recompensasStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalRegistrarNuevaRecompensa.css') }}">
@endpush

@section('main-content')
	<div class="recompensasContainer">
		<div class="firstRow">
			<x-btn-create-item onclick="openModal('modalRegistrarNuevaRecompensa')"> 
				Registrar nueva recompensa
			</x-btn-create-item>

            @include('modals.modalRegistrarNuevaRecompensa')

			<x-btn-edit-item onclick=""> Editar </x-btn-edit-item>
			<x-btn-delete-item onclick=""> Eliminar </x-btn-delete-item>
		</div>

		<!--Tabla de ventas intermediadas-->
        <div class="secondRow">
            <table id="tblRecompensas">
                <thead>
                    <tr>
                        <th class="celda-centered">#</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th class="celda-centered">Costo (puntos)</th>
                        <th class="celda-centered">Fecha y hora de creación</th>
                        <th class="celda-centered">Fecha y hora de actualización</th> 
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($recompensas as $recompensa)
                    <tr>
                        <td class="celda-centered">{{ $contador++ }}</td> 
                        <td>{{ $recompensa->idRecompensa }}</td>
						<td class="celda__tipoRecompensa">
                            <span class="tipoRecompensa__span-{{strtolower(str_replace(' ', '-', $recompensa->tipoRecompensa))}}">
                                {{ $recompensa->tipoRecompensa }}
                            </span>
                        </td>
                        <td>{{ $recompensa->descripcionRecompensa }}</td>
                        <td class="celda-centered">{{ $recompensa->costoPuntos_Recompensa }}</td>
						<td class="celda-centered">{{ $recompensa->created_at}}</td>
						<td class="celda-centered">{{ $recompensa->updated_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
@endsection