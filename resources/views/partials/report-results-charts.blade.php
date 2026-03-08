<!-- Chart Count -->
<div class="w-full flex flex-col items-center justify-center" style="overflow: hidden;">
    <h3 class="text-xl font-bold mb-2 text-center">Rangkuman Distribusi Tingkat Stres</h3>
    <div class="w-full mb-1">
        <canvas id="stressChartCount" width="650" height="300"></canvas>
    </div>
</div>

<!-- Divider -->
<div class="mt-12 mb-8 w-full border-t border-gray-100 pt-8">
    <!-- Chart Percentage -->
    <div class="w-full flex flex-col items-center justify-center" style="overflow: hidden;">
        <h3 class="text-xl font-bold mb-2 text-center">Rangkuman Distribusi Tingkat Stres (%)</h3>
        <div class="w-full mb-1">
            <canvas id="stressChartPct" width="650" height="300"></canvas>
        </div>
    </div>
</div>

<script id="chartDataPayload" type="application/json">
    @json($chartData)
</script>

<script>
    (function() {
        if (typeof Chart === 'undefined') return;
        if (typeof ChartDataLabels !== 'undefined') {
            Chart.register(ChartDataLabels);
        }

        // Shared data
        const rawData = JSON.parse(document.getElementById('chartDataPayload').textContent);
        const labels = rawData.labels;

        // Common Chart Options Template
        const getCommonOptions = (titleY, isPercent = false) => ({
            animation: false,
            animations: false,
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0,
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            if (label.length > 12 && label.includes(' ')) {
                                const words = label.split(' ');
                                const mid = Math.ceil(words.length / 2);
                                return [words.slice(0, mid).join(' '), words.slice(mid).join(' ')];
                            }
                            return label;
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    title: {
                        display: true,
                        text: titleY,
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                datalabels: {
                    color: '#333',
                    anchor: 'end',
                    align: 'top',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    formatter: (value) => value === 0 ? '' : (isPercent ? value + '%' : value)
                }
            }
        });

        // 1. Stress Chart Count
        const ctxCount = document.getElementById('stressChartCount').getContext('2d');
        const dataCount = [rawData.datasets.RINGAN, rawData.datasets.SEDANG, rawData.datasets.BERAT];
        const maxValCount = Math.max(...dataCount.flat(), 1);

        const optionsCount = getCommonOptions('Jumlah Responden', false);
        optionsCount.scales.y.max = Math.ceil(maxValCount * 1.25);

        new Chart(ctxCount, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Ringan',
                        data: rawData.datasets.RINGAN,
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sedang',
                        data: rawData.datasets.SEDANG,
                        backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Berat',
                        data: rawData.datasets.BERAT,
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderWidth: 1
                    }
                ]
            },
            options: optionsCount
        });

        // 2. Stress Chart Percentage
        const ctxPct = document.getElementById('stressChartPct').getContext('2d');
        const dataPct = [rawData.percentages.RINGAN, rawData.percentages.SEDANG, rawData.percentages.BERAT];
        const maxValPct = Math.max(...dataPct.flat(), 1);

        const optionsPct = getCommonOptions('Persentase (%)', true);
        optionsPct.scales.y.max = Math.ceil(maxValPct * 1.25);

        new Chart(ctxPct, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Ringan',
                        data: rawData.percentages.RINGAN,
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sedang',
                        data: rawData.percentages.SEDANG,
                        backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Berat',
                        data: rawData.percentages.BERAT,
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderWidth: 1
                    }
                ]
            },
            options: optionsPct
        });
    })();
</script>