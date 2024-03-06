@extends('layouts.main')

@section('content')
    <div class="row justify-content-center text-center mt-3">
        <div class="col-md-9">
            <h3>Data Nilai Bar Chart</h3>
        </div>
        <div class="col-md-3">
            <a href="/toeic" class="btn btn-primary fs-6 fw-bold">Nilai TOEIC Mahasiswa <i
                    class="bi bi-caret-right-fill"></i></a>
        </div>
        @foreach ($fakultasDataGraph as $fakultas => $data)
            @if ($data->isNotEmpty())
                <div class="col-md-6 mt-3">
                    <h5>{{ $fakultas }}</h5>
                    <canvas id="chart-{{ $fakultas }}" class="chart-container" data-fakultas="{{ $fakultas }}"
                        data-chart-data="{{ json_encode($data) }}"></canvas>
                </div>
            @endif
        @endforeach
    </div>

    <div class="row justify-content-center text-center my-3">
        <h4>Data Nilai Tabel</h4>
        <div class="col-md-8">
            <select id="selectFakultas" class="form-select form-select-sm fw-bold border border-dark">
                <option value="">Pilih Fakultas</option>
                @foreach ($fakultasList as $fakultas)
                    <option value="{{ $fakultas }}">{{ $fakultas }}</option>
                @endforeach
            </select>
            <div id="fakultasTableContainer" class="mt-2"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/chartFakultas.js"></script>
    <script src="js/dataTabel.js"></script>
@endsection
