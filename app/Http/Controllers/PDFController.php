<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Services\PDFService;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    protected $pdfService;

    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Generar PDF de una encuesta de egresado
     */
    public function graduateSurvey(Graduate $graduate)
    {
        $survey = $graduate->survey()->with([
            'distritoNacimiento.provincia.departamento',
            'dependienteEmpresaDistrito.provincia.departamento'
        ])->first();

        $pdf = $this->pdfService->generate(
            'pdf.graduate-survey', // vista blade dedicada al PDF
            compact('graduate', 'survey')
        );

        return $pdf->stream("Encuesta-{$graduate->nombre_completo}.pdf"); // inline
        // return $pdf->download("Encuesta-{$graduate->nombre_completo}.pdf"); // descarga directa
    }
}
