<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ExportPdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    function Requisicion($id)
    {
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        $this->fpdf->SetFillColor(184, 184, 187);
        $this->fpdf->SetTextColor(64);
        $this->fpdf->SetDrawColor(0, 0, 0);
        $this->fpdf->SetLineWidth(0.3);

        /*
        #####################################
        #####################################
                  Salida de pdf
        */

        $this->fpdf->Output('D', "Requisicion");
        exit;
    }
}

class PDF extends Fpdf
{
    protected $fecha, $total;

    function variables($fecha, $total)
    {
        $this->fecha = $fecha;
        $this->total = $total;
    }

    function Header()
    {
        $images = public_path() . '/img';
        $this->Image($images . '/logoqroo.png', 10, 10, 50);
    }
}
