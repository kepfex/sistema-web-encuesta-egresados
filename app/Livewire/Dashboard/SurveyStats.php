<?php

namespace App\Livewire\Dashboard;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SurveyStats extends Component
{
    public $total;
    public $totalYear;
    public $totalMonth;
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $year = now()->year;

        // Totales
        $this->total = Survey::count();
        $this->totalYear = Survey::whereYear('fecha_completado', $year)->count();
        $this->totalMonth = Survey::whereYear('fecha_completado', $year)
            ->whereMonth('fecha_completado', now()->month)
            ->count();

        // Datos para la gráfica
        $monthlyCounts = Survey::select(
                DB::raw('MONTH(fecha_completado) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('fecha_completado', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Construir labels y valores
        $this->chartLabels = collect(range(1, 12))
            ->map(fn($m) => Carbon::create()->month($m)->locale('es')->monthName)
            ->toArray();

        $this->chartData = collect(range(1, 12))
            ->map(fn($m) => $monthlyCounts[$m] ?? 0)
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.survey-stats');
    }
}
