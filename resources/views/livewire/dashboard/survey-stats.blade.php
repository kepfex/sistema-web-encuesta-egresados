<div>
    {{-- Cards de indicadores --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Encuestas</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $total }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-medium">Este Año ({{ now()->year }})</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalYear }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-gray-500 text-sm font-medium">Este Mes ({{ now()->translatedFormat('F') }})</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalMonth }}</p>
        </div>
    </div>

    {{-- Gráfica de barras --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Encuestas por mes</h3>
        <canvas id="surveyChart" height="120"></canvas>
    </div>

    {{-- Script para Chart.js --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('livewire:navigated', renderSurveyChart);
            document.addEventListener('DOMContentLoaded', renderSurveyChart);

            function renderSurveyChart() {
                const ctx = document.getElementById('surveyChart').getContext('2d');
                if (window.surveyChartInstance) {
                    window.surveyChartInstance.destroy();
                }
                window.surveyChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Encuestas',
                            data: @json($chartData),
                            backgroundColor: 'rgba(37, 99, 235, 0.7)', // azul tailwind
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            }
        </script>
    @endpush
</div>

