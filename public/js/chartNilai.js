document.addEventListener("DOMContentLoaded", function() {
    var chartContainers = document.querySelectorAll('.chart-container');

    chartContainers.forEach(function(container) {
        var eic = container.dataset.eic;
        var chartData = JSON.parse(container.dataset.chartData);

        initChart(container.id, chartData);
    });
});

function initChart(canvasId, data) {
    var ctx = document.getElementById(canvasId);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(entry => entry.Tahun),
            datasets: [{
                    label: 'A',
                    data: data.map(entry => entry.A_count),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'B',
                    data: data.map(entry => entry.B_count),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'C',
                    data: data.map(entry => entry.C_count),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'D',
                    data: data.map(entry => entry.D_count),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'E',
                    data: data.map(entry => entry.E_count),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}