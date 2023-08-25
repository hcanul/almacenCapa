<?php

namespace App\Http\Livewire\Storehouse\Warehouse;

use App\Models\Workarea;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class EntriesController extends Component
{
    public $proveedor, $nomComer, $fecha, $fol_entrada, $factura, $nFactura, $ordenCompra, $depSolici, $nReq, $oSolicitante, $tCompraContrato, $nombrerecibe, $observciones;

    public $total, $itemsQuantity, $cart=[];
    public function render()
    {
        $deptos = Workarea::all();



        return view('livewire.storehouse.warehouse.component',
            [
                'deptos' => $deptos,
                'cart' => Cart::getContent()->sortBy('name'),
            ]
        )
                ->extends('layouts.themes.app')
                ->section('content');
    }
}
