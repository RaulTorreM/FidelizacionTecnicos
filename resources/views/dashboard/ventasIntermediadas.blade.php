@extends('layouts.layoutDashboard')

@section('title', 'Ventas Intermediadas')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ventasIntermediadasStyling.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalAgregarVenta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modalAgregarNuevoTecnico.css') }}">
@endpush

@section('main-content')
    <div class="ventasIntermediadasContainer">
        <div class="firstRow">
            <x-btn-create-item onclick="openModal('modalAgregarVenta')"> 
                Agregar nueva venta 
            </x-btn-create-item>

            <!--Modal para agregar nueva venta-->
            @include('modals.modalAgregarVenta')

            <!--Modal para agregar nuevo técnico-->
            @include('modals.modalAgregarNuevoTecnico')
        </div>

        <!--Tabla de cursos locales-->
        <div class="thirdRow">
            <table id="tblVentasIntermediadas">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Número de comprobante</th>
                        <th>Fecha y Hora de Emisión</th>
                        <th>Fecha y Hora Cargada</th>
                        <th>Cliente</th>
                        <th>Monto Total</th>
                        <th>Puntos Generados</th>
                        <th>Técnico</th>
                        <th>Fecha y Hora Redimida</th>
                        <th>Puntos restantes</th>
                        <th>Estado</th> 
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador = 1;
                    @endphp
                    @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $contador++ }}</td> 
                        <td>{{ $venta->idVentaIntermediada }} <br>
                            <small>{{ $venta->tipoComprobante}}</small>
                        </td>
                        <td>{{ $venta->fechaHoraEmision_VentaIntermediada }}</td>
                        <td>{{ $venta->fechaHoraCargada_VentaIntermediada }}</td>
                        <td>{{ $venta->nombreCliente_VentaIntermediada }} <br>
                            <small>{{ $venta->tipoCodigoCliente_VentaIntermediada }}:  
                                   {{ $venta->codigoCliente_VentaIntermediada }}
                            </small>
                        </td>
                        <td>{{ $venta->montoTotal_VentaIntermediada }}</td>
                        <td>{{ $venta->puntosGanados_VentaIntermediada }}</td>
                        <td>{{ $venta->nombreTecnico }} <br>
                            <small>DNI: {{ $venta->idTecnico }}</small>
                        </td>
                        <td>{{ $venta->fechaHoraCanje }}</td>
                        <td>{{ $venta->puntosRestantes}}</td>
                        <td class="estado__celda">
                            <span class="estado__span-{{strtolower(str_replace(' ', '-', $venta->estadoVentaIntermediada))}}">
                                {{ $venta->estadoVentaIntermediada }}
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
@endpush