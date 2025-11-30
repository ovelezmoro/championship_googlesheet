@extends('layouts.upn')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Tabla de Posiciones</h2>
    <h5 class="mb-4 text-center">"COLISEO PRINCIPAL - UNIVERSIDAD PRIVADA DEL NORTE / BREÑA"<br>DEL 23 AL 30 DE NOVIEMBRE DEL 2025</h5>

    @foreach($tabla as $categoria => $series)
    <!-- <h3 class="mt-5">{{ $categoria }}</h3>-->

    @foreach($series as $serie => $equipos)
    <h4 class="mt-3">Categoria: {{ $categoria }} - Serie: {{ $serie }}</h4>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-striped text-center">
            <thead class="bg-smtp">
                <tr>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>G</th>
                    <th>P</th>
                    <th>SP</th>
                    <th>SF</th>
                    <th>SC</th>
                    <th>RS</th>
                    <th>PF</th>
                    <th>PC</th>
                    <th>RP</th>
                    <th>PTOS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $row)
                <tr>
                    <td>{{ $row['EQUIPO'] }}</td>
                    <td>{{ $row['PJ'] }}</td>
                    <td>{{ $row['G'] }}</td>
                    <td>{{ $row['P'] }}</td>
                    <td>{{ $row['SP'] }}</td>
                    <td>{{ $row['SF'] }}</td>
                    <td>{{ $row['SC'] }}</td>
                    <td>{{ $row['RS'] }}</td>
                    <td>{{ $row['PF'] }}</td>
                    <td>{{ $row['PC'] }}</td>
                    <td>{{ $row['RP'] }}</td>
                    <td>{{ $row['PTOS'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
    @endforeach

</div>
@endsection
