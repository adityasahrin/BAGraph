@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h4>Data Mahasiswa KRS UIGM</h4>
            <canvas id="chartJmlAll"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Data Mahasiswa KRS Fakultas</h4>
            <canvas id="chartFaculties"></canvas>
        </div>
    </div>

    <h4 class="mt-3">Data Mahasiswa Baru</h4>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Fakultas</th>
                <th scope="col" class="text-center">2019</th>
                <th scope="col" class="text-center">2020</th>
                <th scope="col" class="text-center">2021</th>
                <th scope="col" class="text-center">2022</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataFakultas as $fakultas => $queryResult)
                <tr>
                    <td>{{ $fakultas }}</td>
                    @foreach ($queryResult as $result)
                        <td class="text-center">{{ $result->JumlahMahasiswa }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctxJmlAll = document.getElementById('chartJmlAll').getContext('2d');
        var ctxFaculties = document.getElementById('chartFaculties').getContext('2d');

        var years = @json($listTahun); // Ambil list tahun dari controller
        var dataUIGM = @json($dataUIGM); // Ambil data dari controller
        var faculties = ['FE', 'FT', 'FKIP', 'FIPB', 'FIlkom']; // Exclude 'JmlAll'

        // Chart JmlAll
        var myChartJmlAll = new Chart(ctxJmlAll, {
            type: 'line', // Ganti tipe chart menjadi line
            data: {
                labels: years,
                datasets: [{
                    label: 'JmlAll',
                    data: years.map(function(year) {
                        return dataUIGM[year][0]['JmlAll'];
                    }),
                    borderColor: 'rgb(255, 99, 132)', // Warna garis
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart Fakultas
        var facultiesColors = ['rgb(255, 0, 0)', 'rgb(0, 255, 0)', 'rgb(0, 0, 255)', 'rgb(255, 255, 0)',
            'rgb(255, 0, 255)'
        ];

        var datasetsFaculties = faculties.map(function(faculty, index) {
            return {
                label: faculty,
                data: years.map(function(year) {
                    return dataUIGM[year][0][faculty];
                }),
                borderColor: facultiesColors[index],
                borderWidth: 2,
                fill: false,
                tension: 0.1
            };
        });

        var myChartFaculties = new Chart(ctxFaculties, {
            type: 'line', // Ganti tipe chart menjadi line
            data: {
                labels: years,
                datasets: datasetsFaculties
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
