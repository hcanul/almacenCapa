<?php

namespace App\Http\Controllers;

use App\Models\Demands;
use App\Models\DepartamentBoss;
use App\Models\Detsol;
use App\Models\Inventory;
use App\Models\Measurementunits;
use App\Models\User;
use App\Models\Workarea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;

class ExportPdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDF;
    }

    function Requisicion($id)
    {
        $soli = Demands::find($id);
        $nombre = User::find($soli->user_id)->name;
        $donde = DepartamentBoss::where('name', 'like', '%'. $nombre . '%')->get();
        $depto = Workarea::find($donde[0]->workarea_id);

        setlocale(LC_MONETARY,'es_MX');

        $this->fpdf->variables(
            Carbon::now()->format('Y-m-d'),
            $soli->total,
            $nombre,
            $depto->name,
            $soli->id,
            $soli->actividad,
        );

        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage();
        $this->fpdf->SetFillColor(184, 184, 187);
        $this->fpdf->SetTextColor(64);
        $this->fpdf->SetDrawColor(0, 0, 0);
        $this->fpdf->SetLineWidth(0.3);

        $this->fpdf->Ln(20);

        $rate = Detsol::whereDemandId($id)->get();

        $header = array('NUM INV', 'DECRIPCION', 'UNIDAD', 'CANTIDAD', 'COSTO', 'SUBTOTAL');
        $this->fpdf->FancyTable($header, $rate);

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
    public $fecha, $total, $solicitante, $departamento, $folio, $observaciones;

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
        $this->Ln(15);

        $this->RoundedRect(10, 45, 190, 50, 10);

        $this->SetFont('Arial', 'B', 8);
        $col_width = $this->GetPageWidth() / 6;
        $this->Cell($col_width, 4, 'SOLICITANTE:', 0, 0, 'L', false);
        $this->Cell($col_width / 8, 4, ' ', 0, 0, 'C', false);
        $this->SetFont('Arial', '', 8);
        $this->Cell($col_width * 2 +10, 4, utf8_decode($this->solicitante), 'B', 0, 'C', false);
        $this->Cell($col_width / 4, 4, '', 0, 0, 'C', false);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($col_width - 10, 4, 'FECHA:', 0, 0, 'L', false);
        $this->SetFont('Arial', '', 8);
        $this->Cell($col_width, 4, $this->fecha, 'B', 0, 'C', false);

        $this->Ln(8);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($col_width, 4, 'DEPARTAMENTO:', 0, 0, 'L', false);
        $this->Cell($col_width / 8, 4, ' ', 0, 0, 'C', false);
        $this->SetFont('Arial', '', 8);
        $this->Cell($col_width * 2 +10, 4, utf8_decode($this->departamento), 'B', 0, 'C', false);
        $this->Cell($col_width / 4, 4, '', 0, 0, 'C', false);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell($col_width - 10, 4, 'FOLIO:', 0, 0, 'L', false);
        $this->SetFont('Arial', '', 10);
        $this->Cell($col_width, 4, $this->folio, 'B', 0, 'C', false);

        $this->Ln(10);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell($col_width, 4, 'ACTIVIDAD:', 0, 0, 'C', false);
        $this->Ln(5);
        $this->SetFont('Arial', '', 8);
        $this->Cell($col_width / 6, 4, '', 0, 0, 'C', false);
        $this->MultiCell($col_width * 5, 4, utf8_decode($this->observaciones), 0, 'J', false);




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

    function FancyTable($header, $rate)
    {
        $this->SetFillColor(169, 50, 38);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('Arial','B');

        $col_width = $this->GetPageWidth() / 8;
        foreach ($header as $key => $value) {
            if ($key == 1)
            {
                $this->Cell($col_width * 2, 7, $value, 1, 0, 'C', true);
            }
            else
            {
                $this->Cell($col_width, 7, $value, 1, 0, 'C', true);
            }
        }
        $this->Ln();
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $fill=false;
        foreach ($rate as $key => $value) {
            $inven = Inventory::find($value->inventory_id);
            $unidad = Measurementunits::find($inven->measurementunits_id)->name;
            $this->SetFont('Arial','B', 8);
            $this->Cell($col_width, 7, $inven->numInv, 1, 0, 'C', $fill);
            $this->SetFont('Arial','B', 6);
            $this->Cell($col_width * 2, 7, Str::limit(utf8_decode($inven->descripcion), 34, '...'), 1, 0, 'C', $fill);
            $this->SetFont('Arial','B', 8);
            $this->Cell($col_width, 7, $unidad, 1, 0, 'C', $fill);
            $this->Cell($col_width, 7, $value->cantidad, 1, 0, 'C', $fill);
            $this->Cell($col_width, 7, $value->costo, 1, 0, 'C', $fill);
            $this->Cell($col_width, 7, $value->total, 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }

    }
}
