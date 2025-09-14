<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class PDFService
{
    /**
     * Genera un PDF a partir de una vista Blade y datos.
     *
     * @param string $view Nombre de la vista blade
     * @param array $data Datos que se pasan a la vista
     * @param string|null $filename Nombre sugerido para el archivo
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generate(string $view, array $data = [], ?string $filename = null)
    {
        $pdf = Pdf::loadView($view, $data)
            ->setPaper('A4', 'portrait'); // Cambiar a landscape si necesitas horizontal

        // Si quieres guardarlo en storage/app/pdfs
        if ($filename) {
            $path = storage_path("app/pdfs/{$filename}.pdf");
            $pdf->save($path);
        }

        return $pdf;
    }
}
