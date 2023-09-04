<?php

use Codedge\Fpdf\Fpdf\Fpdf;


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
        $images = public_path() . '\img';
        $this->Image($images . '\logoqroo.png', 10, 10, 50);
    }
}

function Requisicion()
    {
        $pdf = new PDF('P', 'mm', 'LETTER');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFillColor(184, 184, 187);
        $pdf->SetTextColor(64);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);

        /*
        #####################################
        #####################################
                  Salida de pdf
        */

        $pdf->Output('D', "Requisicion");
    }

?>
