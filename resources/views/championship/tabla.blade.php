@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Tabla de Posiciones</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>G</th>
                    <th>P</th>
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
                @foreach($tabla as $row)
                    <tr>
                        <td>{{ $row['Rank'] ?? '-' }}</td>
                        <td>{{ $row['EQUIPO'] }}</td>
                        <td>{{ $row['PJ'] }}</td>
                        <td>{{ $row['G'] }}</td>
                        <td>{{ $row['P'] }}</td>
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
</div>
@endsection
