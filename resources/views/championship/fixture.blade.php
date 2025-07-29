@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Tabla de Partidos Finales</h2>
    <h5 class="mb-4 text-center">"COLISEO FIA - UNIVERSIDAD SAN MARTÍN DE PORRES / LA MOLINA"<br>DEL 23 AL 30 DE JULIO DEL 2025</h5>

    @foreach ($partidosPorCategoria as $categoria => $series)
    <h2 class="text-center mb-4">{{ $categoria }}</h2>
    <div class="row">
        @foreach ($series as $serie => $partidos)
        <div class="col-md-4 mb-4">
            <h4 class="text-center">{{ $serie }}</h4>

            @foreach ($partidos as $p)
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <small class="text-muted d-block mb-2">
                        {{ $p['FECHA'] ?? 'Por definirse' }}
                    </small>

                    {{-- Equipo Local --}}
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <img src="{{ asset('images/shield-gray.svg') }}" alt="" width="20" class="me-2">
                        <strong>{{ $p['LOCAL'] ?? 'Por Definirse' }}</strong>
                    </div>

                    {{-- Equipo Visita --}}
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <img src="{{ asset('images/shield-gray.svg') }}" alt="" width="20" class="me-2">
                        <strong>{{ $p['VISITA'] ?? 'Por Definirse' }}</strong>
                    </div>

                    {{-- Resultado Sets --}}
                    <div class="d-flex justify-content-center gap-3">
                        <span>{{ $p['SETS_LOCAL'] }}-{{ $p['SETS_VISITA'] }}</span>
                        <span>{{ $p['SET1_LOCAL'] }}-{{ $p['SET1_VISITA'] }}</span>
                        <span>{{ $p['SET2_LOCAL'] }}-{{ $p['SET2_VISITA'] }}</span>
                        <span>{{ $p['SET3_LOCAL'] }}-{{ $p['SET3_VISITA'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection