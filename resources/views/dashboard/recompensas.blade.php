@extends('layouts.layoutDashboard')

@section('title', 'Recompensas')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/recompensasStyle.css') }}">
@endpush

@section('main-content')
	<div class="recompensasContainer">
		<div class="firstRow">
			<div class="btnCreateItem-container">
				<button class="btnCreateItem" onclick="">
					Registrar nueva recompensa
					<span class="material-symbols-outlined">add_circle</span>
				</button>
			</div>
			<div class="btnEditItem-container">
				<button class="btnEditItem" onclick="">
					Editar
					<span class="material-symbols-outlined">edit</span>
				</button>
			</div>
			<div class="btnCreateItem-container">
				<button class="btnCreateItem" onclick="">
					Registrar nueva recompensa
					<span class="material-symbols-outlined">add_circle</span>
				</button>
			</div>
		</div>
	</div>
@endsection