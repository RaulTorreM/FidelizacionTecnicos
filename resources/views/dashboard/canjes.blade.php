@extends('layouts.layoutDashboard')

@section('title', 'Canjes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/canjesStyle.css') }}">
@endpush

@section('main-content')
	<div class="canjesContainer">
		<div class="firstRow">
			<h3>Registrar nuevo canje</h3>
		</div>
		<div class="secondRow">
			<div class="verticalPairGroup">
				<label class="primary-label"> Fecha de canje </label>
				<input type="date">
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Técnico </label>
				<input type="date">
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Puntos Actuales </label>
				<input type="date">
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Número de comprobante </label>
				<input type="date">
			</div>
			<div class="verticalPairGroup">
				<label class="primary-label"> Monto total </label>
				<input type="date">
			</div>
		</div>
	</div>

@endsection