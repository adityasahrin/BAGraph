@extends('layouts.main')

@section('content')
    <div class="row justify-content-center text-center p-3">
        <h3>Data Nilai EIC</h3>
        @foreach ($mkDataGraph as $mk => $data)
            @if ($data->isNotEmpty())
                <div class="col-md-6 mt-3">
                    <h5>{{ $mk }}</h5>
                    <canvas id="chart-{{ $mk }}" class="chart-container" data-mk="{{ $mk }}"
                        data-chart-data="{{ json_encode($data) }}"></canvas>
                </div>
            @endif
        @endforeach
    </div>

    <div class="row justify-content-center text-center my-3">
        <h4>Data Nilai Tabel</h4>
        <div class="col-md-8">
            <select id="selectEIC" class="form-select form-select-sm fw-bold border border-dark">
                <option value="">Pilih Mata Kuliah</option>
                @foreach ($mkList as $mk)
                    <option value="{{ $mk }}">{{ $mk }}</option>
                @endforeach
            </select>
            <div id="EICTableContainer" class="mt-2"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/chartNilai.js"></script>
    <script src="js/dataTabelEIC.js"></script>
@endsection
