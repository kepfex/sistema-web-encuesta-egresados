<div>
    {{-- Cards de indicadores con nuevo diseño --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-indigo-50/20 dark:bg-gray-800 shadow-lg rounded-xl p-6 flex items-center justify-between hover:shadow-xl transition-shadow duration-300">
            <div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Encuestas</h3>
                <p class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $total }}</p>
            </div>
            <div class="bg-indigo-100 dark:bg-indigo-900/50 rounded-full p-4">
                {{-- Tabler Icon: checklist --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                   <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                   <path d="M14 19l2 2l4 -4"></path>
                   <path d="M9 8h4"></path>
                   <path d="M9 12h2"></path>
                </svg>
            </div>
        </div>

        <div class="bg-emerald-50/20 dark:bg-gray-800 shadow-lg rounded-xl p-6 flex items-center justify-between hover:shadow-xl transition-shadow duration-300">
            <div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Este Año ({{ now()->year }})</h3>
                <p class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $totalYear }}</p>
            </div>
            <div class="bg-emerald-100 dark:bg-emerald-900/50 rounded-full p-4">
                {{-- Tabler Icon: calendar-stats --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 dark:text-emerald-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                   <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"></path>
                   <path d="M18 14v4h4"></path>
                   <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                   <path d="M15 3v4"></path>
                   <path d="M7 3v4"></path>
                   <path d="M4 11h7"></path>
                </svg>
            </div>
        </div>

        <div class="bg-amber-50/20 dark:bg-gray-800 shadow-lg rounded-xl p-6 flex items-center justify-between hover:shadow-xl transition-shadow duration-300">
            <div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Este Mes ({{ now()->translatedFormat('F') }})</h3>
                <p class="mt-2 text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $totalMonth }}</p>
            </div>
            <div class="bg-amber-100 dark:bg-amber-900/50 rounded-full p-4">
                {{-- Tabler Icon: calendar-due --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600 dark:text-amber-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                   <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                   <path d="M16 3v4"></path>
                   <path d="M8 3v4"></path>
                   <path d="M4 11h16"></path>
                   <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                </svg>
            </div>
        </div>
        
    </div>

    {{-- Gráfica de barras (sin cambios) --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Encuestas por mes</h3>
        <canvas id="surveyChart" height="120"></canvas>
    </div>

    {{-- Script para Chart.js (sin cambios) --}}
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
                            backgroundColor: 'rgba(37, 99, 235, 0.7)',
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