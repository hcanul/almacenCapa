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

        $this->fpdf->Output('D', "Requisicion.pdf");
        exit;
    }
}

class PDF extends Fpdf
{
    protected $fecha, $total, $solicitante, $departamento, $folio, $observaciones;

    function variables($fecha, $total, $solicitante, $departamento, $folio, $observaciones)
    {
        $this->fecha = $fecha;
        $this->total = $total;
        $this->solicitante = $solicitante;
        $this->departamento = $departamento;
        $this->folio = $folio;
        $this->observaciones = $observaciones;
    }

    function Header()
    {
        $images = public_path() . '/img';
        $this->Image($images . '/logoqroo.png', 10, 10, 15);
        $this->Image($images . '/capa.png', 150, 10, 50);
        $this->SetFont('Arial', 'B', 10);
        $this->Ln(5);
        $this->Cell(0, 10, 'COMISION DE AGUA POTABLE Y ALCANTARILLADO', 0, 0, 'C', false);
        $this->Ln(5);
        $this->Cell(0, 10, 'DEL ESTADO DE QUINTANA ROO', 0, 0, 'C', false);
        $this->SetFont('Arial', '', 8);
        $this->Ln(5);
        $this->Cell(0, 8, 'ORG. OPER. FELIPE CARRILLO PUERTO', 0, 0, 'C', false);
        $this->Ln(5);
        $this->Cell(0, 8, 'DEPARTAMENTO DE RECURSOS MATERIALES', 0, 0, 'C', false);
        $this->Ln(6);
        $this->Cell(0, 4, 'SOLICITUD DE MATERIAL A ALMACEN', 0, 0, 'C', false);
        $this->Ln(20);

        $this->RoundedRect(10, 45, 190, 50, 10);

        $col_width = $this->GetPageWidth() / 6;
        $this->Cell($col_width, 4, 'SOLICITANTE:', 0, 0, 'C', false);
        $this->Cell($col_width / 2, '', 0, 0, 'C', false);
        $this->Cell($col_width * 2, $this->solicitante, 0, 0, 'C', false);


    }

    function footer()
    {

    }

    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
}
