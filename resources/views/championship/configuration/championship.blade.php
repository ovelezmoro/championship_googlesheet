@extends('layouts.upn')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">Mantenimiento de Campeonato</h1>

            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-secondary">Volver</button>
                <button type="button" class="btn btn-outline-primary">Guardar</button>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        {{-- Nombre --}}
                        <div class="col-md-6">
                            <label class="form-label">Nombre del campeonato</label>
                            <input type="text" class="form-control"
                                   placeholder="Ej: Copa Verano U-10">
                        </div>

                        {{-- Deporte --}}
                        <div class="col-md-3">
                            <label class="form-label">Deporte</label>
                            <select class="form-select">
                                <option selected>Vóley</option>
                                <option>Fútbol</option>
                                <option>Básquet</option>
                                <option>Otro</option>
                            </select>
                        </div>

                        {{-- Ubicación --}}
                        <div class="col-md-3">
                            <label class="form-label">Ubicación</label>
                            <input type="text" class="form-control"
                                   placeholder="Ej: Coliseo Eduardo Dibós">
                        </div>

                        {{-- Fechas --}}
                        <div class="col-md-3">
                            <label class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha de fin</label>
                            <input type="date" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Detalle de ubicación</label>
                            <textarea class="form-control" rows="2"
                                      placeholder="Dirección, referencia, ciudad, etc."></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Configuración de puntaje --}}
                    <h2 class="h6 mb-3">Configuración de puntaje (sets al mejor de 3)</h2>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Victoria 2–0</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Puntos</span>
                                <input type="number" class="form-control" value="3">
                            </div>
                            <div class="form-text">PUNTOS_VICTORIA_2_0</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Victoria 2–1</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Puntos</span>
                                <input type="number" class="form-control" value="2">
                            </div>
                            <div class="form-text">PUNTOS_VICTORIA_2_1</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Derrota 1–2</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Puntos</span>
                                <input type="number" class="form-control" value="1">
                            </div>
                            <div class="form-text">PUNTOS_DERROTA_1_2</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Derrota 0–2</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Puntos</span>
                                <input type="number" class="form-control" value="0">
                            </div>
                            <div class="form-text">PUNTOS_DERROTA_0_2</div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
