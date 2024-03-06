<table class="table table-bordered border-dark">
    <thead>
        <tr>
            <th>Tahun</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th>E</th>
            <th>A + B</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->Tahun }}</td>
                <td>{{ number_format($item->A_percentage, 2) }}%</td>
                <td>{{ number_format($item->B_percentage, 2) }}%</td>
                <td>{{ number_format($item->C_percentage, 2) }}%</td>
                <td>{{ number_format($item->D_percentage, 2) }}%</td>
                <td>{{ number_format($item->E_percentage, 2) }}%</td>
                <td>{{ number_format($item->A_percentage + $item->B_percentage, 2) }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
