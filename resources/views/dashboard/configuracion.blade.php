@extends('layouts.layoutDashboard')

@section('title', 'Configuración')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracionStyle.css') }}">
@endpush

@section('main-content')
	Aquí se podrá configurar el sistema web
@endsection