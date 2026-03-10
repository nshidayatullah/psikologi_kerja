@php
$data = $record ?? null;
$totals = [];
if ($data) {
$totals = $data->getTotalsByCategory();
}

$categories = \App\Models\QuestionCategory::all();
$labels = $categories->pluck('name')->toArray();
$chartData = [];
foreach ($categories as $category) {
$chartData[] = $totals[$category->id] ?? 0;
}
@endphp

<style>
    .fi-full-width-page .fi-main,
    .fi-full-width-page .fi-main-ctn,
    .fi-full-width-page .fi-page,
    .fi-full-width-page .fi-page-header-main-ctn,
    .fi-full-width-page .fi-page-main,
    .fi-full-width-page .fi-page-content,
    .fi-full-width-page .fi-page-body,
    .fi-full-width-page .fi-section,
    .fi-full-width-page .fi-section-content-ctn,
    .fi-full-width-page .fi-section-content,
    .fi-full-width-page .fi-layout,
    .fi-full-width-page .fi-topbar-ctn,
    .fi-full-width-page .fi-page-header,
    .fi-full-width-page form {
        max-width: none !important;
        width: 100% !important;
    }
</style>

<div class="flex flex-col items-center justify-center p-4 w-full">
    <div class="w-full" style="min-height: 600px;">
        <canvas
            id="radarChartCanvas"
            x-data="{
                chart: null,
                init() {
                    setTimeout(() => {
                        if (typeof Chart === 'undefined') {
                            console.error('Chart.js is not loaded');
                            return;
                        }

                        if (this.chart) this.chart.destroy();

                        if (typeof ChartDataLabels !== 'undefined') {
                            Chart.register(ChartDataLabels);
                        }

                        const backgroundZonesPlugin = {
                            id: 'backgroundZones',
                            beforeDraw: (chart) => {
                                const { ctx, scales: { r } } = chart;
                                const numLabels = chart.data.labels.length;

                                const zones = [
                                    { max: 35, color: 'rgba(239, 68, 68, 0.15)' },
                                    { max: 23, color: 'rgba(245, 158, 11, 0.2)' },
                                    { max: 11, color: 'rgba(16, 185, 129, 0.25)' }
                                ];

                                zones.forEach(zone => {
                                    ctx.beginPath();
                                    for (let i = 0; i < numLabels; i++) {
                                        const point = r.getPointPositionForValue(i, zone.max);
                                        if (i === 0) {
                                            ctx.moveTo(point.x, point.y);
                                        } else {
                                            ctx.lineTo(point.x, point.y);
                                        }
                                    }
                                    ctx.closePath();
                                    ctx.fillStyle = zone.color;
                                    ctx.fill();
                                });
                            }
                        };

                        const chartData = @js($chartData);
                        const themeColor = 'rgba(71, 85, 105, ';
                        const borderTheme = 'lime'; // Diubah menjadi lime

                        this.chart = new Chart($el, {
                            type: 'radar',
                            data: {
                                labels: @js($labels),
                                datasets: [{
                                    label: 'Skor Stressor',
                                    data: chartData,
                                    fill: true,
                                    backgroundColor: themeColor + '0.25)',
                                    borderColor: borderTheme,
                                    pointBackgroundColor: borderTheme,
                                    pointBorderColor: '#fff',
                                    pointHoverBackgroundColor: '#fff',
                                    pointHoverBorderColor: borderTheme,
                                    pointRadius: 4,
                                    pointHoverRadius: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    r: {
                                        angleLines: { display: true },
                                        grid: {
                                            circular: false,
                                            color: 'rgba(0, 0, 0, 0.05)'
                                        },
                                        suggestedMin: 0,
                                        suggestedMax: 35,
                                        ticks: {
                                            stepSize: 5,
                                            backdropColor: 'transparent',
                                            z: 1,
                                            font: { size: 10 }
                                        }
                                    }
                                },
                                plugins: {
                                    legend: { display: false },
                                    datalabels: {
                                        display: true,
                                        color: '#334155',
                                        font: {
                                            weight: 'bold',
                                            size: 11
                                        },
                                        offset: 4
                                    }
                                }
                            },
                            plugins: [backgroundZonesPlugin]
                        });
                    }, 50);
                }
            }"
            style="width: 100%; height: 600px;"></canvas>
    </div>
</div>