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
	</div>
@endsection