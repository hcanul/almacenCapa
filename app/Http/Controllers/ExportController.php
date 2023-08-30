<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ExportController extends Controller
{
    public function reportPDF($id)
    {
        $pdf = PDF::loadView('pdf.entrada', compact('id'));

        return $pdf->stream('Entrada.pdf');
    }
}
