@extends('layouts.upn')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Registrar Equipo Deportivo</h1>
            <a href="#" class="btn btn-outline-secondary btn-sm">
                Volver
            </a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf

                    <div class="row g-3">
                        {{-- Nombre del equipo --}}
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del equipo</label>
                            <input type="text"
                                   class="form-control @error('nombre') is-invalid @enderror"
                                   id="nombre"
                                   name="nombre"
                                   value="{{ old('nombre') }}"
                                   placeholder="Ej: Los Tigres FC">
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Departamento --}}
                        <div class="col-md-4">
                            <label for="departamento" class="form-label">Departamento</label>
                            <select id="departamento"
                                    name="departamento"
                                    class="form-select @error('departamento') is-invalid @enderror">
                                <option value="">Seleccione...</option>
                                {{-- Se rellenará por JS --}}
                            </select>
                            @error('departamento')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Provincia --}}
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select id="provincia"
                                    name="provincia"
                                    class="form-select @error('provincia') is-invalid @enderror"
                                    disabled>
                                <option value="">Seleccione un departamento primero...</option>
                            </select>
                            @error('provincia')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Distrito --}}
                        <div class="col-md-4">
                            <label for="distrito" class="form-label">Distrito</label>
                            <select id="distrito"
                                    name="distrito"
                                    class="form-select @error('distrito') is-invalid @enderror"
                                    disabled>
                                <option value="">Seleccione una provincia primero...</option>
                            </select>
                            @error('distrito')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tabla de jugadores --}}
                    <hr class="my-4">

                    <h2 class="h5 mb-3">Jugadores</h2>
                    <div class="table-responsive mb-3">
                        <table class="table table-sm align-middle" id="tabla-jugadores">
                            <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nombre completo</th>
                                <th style="width: 180px;">Posición</th>
                                <th style="width: 120px;">Número</th>
                                <th style="width: 50px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- Filas dinámicas por JS --}}
                            </tbody>
                        </table>
                    </div>

                    <button type="button" id="btn-agregar-jugador" class="btn btn-outline-primary btn-sm mb-3">
                        Agregar jugador
                    </button>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            Guardar equipo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ubigeo Perú (ejemplo, extiende según necesites)
        const ubigeoPeru = {
            "Lima": {
                "Lima": [
                    "Lima",
                    "Miraflores",
                    "San Isidro",
                    "Surco",
                    "San Miguel",
                    "La Molina",
                    "San Borja"
                ],
                "Huaral": [
                    "Huaral",
                    "Chancay"
                ],
                "Cañete": [
                    "San Vicente de Cañete",
                    "Asia",
                    "Mala"
                ]
            },
            "Arequipa": {
                "Arequipa": [
                    "Arequipa",
                    "Cerro Colorado",
                    "Yanahuara"
                ],
                "Camana": [
                    "Camaná"
                ]
            },
            "La Libertad": {
                "Trujillo": [
                    "Trujillo",
                    "Víctor Larco",
                    "El Porvenir"
                ]
            },
            "Cusco": {
                "Cusco": [
                    "Cusco",
                    "San Sebastián",
                    "San Jerónimo"
                ]
            },
            "Piura": {
                "Piura": [
                    "Piura",
                    "Castilla",
                    "Catacaos"
                ]
            }
            // Agrega más departamentos/provincias/distritos según requiera tu proyecto
        };

        document.addEventListener('DOMContentLoaded', function () {
            const departamentoSelect = document.getElementById('departamento');
            const provinciaSelect = document.getElementById('provincia');
            const distritoSelect = document.getElementById('distrito');

            // Poblar departamentos (solo una vez)
            Object.keys(ubigeoPeru).forEach(dep => {
                const opt = document.createElement('option');
                opt.value = dep;
                opt.textContent = dep;
                if ("{{ old('departamento') }}" === dep) {
                    opt.selected = true;
                }
                departamentoSelect.appendChild(opt);
            });

            function resetSelect(select, placeholder, disabled = true) {
                select.innerHTML = '';
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = placeholder;
                select.appendChild(opt);
                select.disabled = disabled;
            }

            function cargarProvincias() {
                const dep = departamentoSelect.value;
                resetSelect(provinciaSelect, dep ? 'Seleccione provincia...' : 'Seleccione un departamento primero...', !dep);
                resetSelect(distritoSelect, 'Seleccione una provincia primero...', true);

                if (!dep || !ubigeoPeru[dep]) return;

                Object.keys(ubigeoPeru[dep]).forEach(prov => {
                    const opt = document.createElement('option');
                    opt.value = prov;
                    opt.textContent = prov;
                    if ("{{ old('provincia') }}" === prov) {
                        opt.selected = true;
                    }
                    provinciaSelect.appendChild(opt);
                });

                provinciaSelect.disabled = false;
                if ("{{ old('provincia') }}") {
                    cargarDistritos(); // si viene con old
                }
            }

            function cargarDistritos() {
                const dep = departamentoSelect.value;
                const prov = provinciaSelect.value;

                resetSelect(distritoSelect, prov ? 'Seleccione distrito...' : 'Seleccione una provincia primero...', !prov);

                if (!dep || !prov || !ubigeoPeru[dep] || !ubigeoPeru[dep][prov]) return;

                ubigeoPeru[dep][prov].forEach(dis => {
                    const opt = document.createElement('option');
                    opt.value = dis;
                    opt.textContent = dis;
                    if ("{{ old('distrito') }}" === dis) {
                        opt.selected = true;
                    }
                    distritoSelect.appendChild(opt);
                });

                distritoSelect.disabled = false;
            }

            departamentoSelect.addEventListener('change', cargarProvincias);
            provinciaSelect.addEventListener('change', cargarDistritos);

            // Cargar datos iniciales si hay old()
            if ("{{ old('departamento') }}") {
                cargarProvincias();
            }

            // ---- Tabla dinámica de jugadores ----
            const tablaJugadoresBody = document.querySelector('#tabla-jugadores tbody');
            const btnAgregarJugador = document.getElementById('btn-agregar-jugador');

            function actualizarIndices() {
                Array.from(tablaJugadoresBody.children).forEach((row, index) => {
                    row.querySelector('.jugador-index').textContent = index + 1;
                });
            }

            function crearFilaJugador() {
                const index = tablaJugadoresBody.children.length;
                const tr = document.createElement('tr');

                tr.innerHTML = `
            <td class="jugador-index">${index + 1}</td>
            <td>
                <input type="text"
                       name="jugadores[${index}][nombre]"
                       class="form-control form-control-sm"
                       placeholder="Nombre del jugador">
            </td>
            <td>
                <select name="jugadores[${index}][posicion]" class="form-select form-select-sm">
                    <option value="">Seleccione...</option>
                    <option value="Arquero">Arquero</option>
                    <option value="Defensa">Defensa</option>
                    <option value="Volante">Volante</option>
                    <option value="Delantero">Delantero</option>
                </select>
            </td>
            <td>
                <input type="number"
                       name="jugadores[${index}][numero]"
                       class="form-control form-control-sm"
                       placeholder="N°">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar-jugador">&times;</button>
            </td>
        `;

                tablaJugadoresBody.appendChild(tr);
            }

            btnAgregarJugador.addEventListener('click', function () {
                crearFilaJugador();
            });

            tablaJugadoresBody.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-eliminar-jugador')) {
                    e.target.closest('tr').remove();
                    actualizarIndices();
                }
            });

            // Agregar una fila inicial
            if (tablaJugadoresBody.children.length === 0) {
                crearFilaJugador();
            }
        });
    </script>
@endpush
