@extends('layouts.upn')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">U-10 · Mantenimiento de Series</h1>

            {{-- Solo visual, botones sin funcionalidad --}}
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i> Nueva serie
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-save"></i> Guardar cambios
                </button>
            </div>
        </div>

        {{-- Filtros / resumen superiores (solo maqueta) --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body py-2">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label mb-0 small text-muted">Categoría</label>
                        <select class="form-select form-select-sm" disabled>
                            <option>U-10</option>
                            <option>U-12</option>
                            <option>U-14</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label mb-0 small text-muted">Torneo</label>
                        <input type="text" class="form-control form-control-sm" value="Copa Verano 2025" disabled>
                    </div>
                    <div class="col-md-6 text-end">
                        <span class="badge bg-primary">16 equipos</span>
                        <span class="badge bg-secondary">4 series</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Series / Grupos --}}
        <div class="row g-3">

            {{-- SERIE A --}}
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-center py-2">
                        <div class="small text-muted">U-10</div>
                        <strong>SERIE A</strong>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-sm mb-0 align-middle">
                            <tbody>
                            <tr>
                                <td>UPN SANTAS</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">
                                        ⇄
                                    </button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">
                                        &times;
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>ATENEA</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>MOLIVOLEY ELITE</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>CLUB IPDE IQUITOS</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nuevo equipo">
                            <button class="btn btn-outline-primary" type="button">
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERIE B --}}
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-center py-2">
                        <div class="small text-muted">U-10</div>
                        <strong>SERIE B</strong>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-sm mb-0 align-middle">
                            <tbody>
                            <tr>
                                <td>GEMINIS A</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>REBAZA ACOSTA</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>MOLIVOLEY DIAMOND</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ROSARIO</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nuevo equipo">
                            <button class="btn btn-outline-primary" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERIE C --}}
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-center py-2">
                        <div class="small text-muted">U-10</div>
                        <strong>SERIE C</strong>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-sm mb-0 align-middle">
                            <tbody>
                            <tr>
                                <td>COLIBRI IQUITOS</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>UPN ALBAS</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>J&amp;J AREQUIPA</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>VILLASMIL</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nuevo equipo">
                            <button class="btn btn-outline-primary" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SERIE D --}}
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-center py-2">
                        <div class="small text-muted">U-10</div>
                        <strong>SERIE D</strong>
                    </div>
                    <div class="card-body p-2">
                        <table class="table table-sm mb-0 align-middle">
                            <tbody>
                            <tr>
                                <td>CLUB HUAYCAN</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>GEMINIS B</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>MOLIVOLEIBOL TOP</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            <tr>
                                <td>REMPORT PUCALLPA</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-outline-secondary btn-xs btn-sm" type="button">⇄</button>
                                    <button class="btn btn-outline-danger btn-xs btn-sm" type="button">&times;</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer p-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Nuevo equipo">
                            <button class="btn btn-outline-primary" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
