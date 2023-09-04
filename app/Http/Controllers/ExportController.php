<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Models\WarehouseEntry;
use App\Models\WarehouseProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;




class ExportController extends Controller
{
    public function reportPDF($id)
    {
        $header = WarehouseEntry::find($id);
        $detalles = WarehouseProduct::wherewarehouseEntriesId($id)->get();
        $almacen = Boss::whereWorkareaId(13)->get()[0];
        $subgerente = Boss::whereWorkareaId(2)->get()[0];
        $materiales = Boss::whereWorkareaId(6)->get()[0];
        $pdf = PDF::loadView('pdf.entrada', compact('header', 'detalles', 'almacen', 'subgerente', 'materiales'));

        return $pdf->stream('Entrada.pdf');
    }
}
