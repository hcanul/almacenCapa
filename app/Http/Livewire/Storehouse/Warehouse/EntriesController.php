<?php

namespace App\Http\Livewire\Storehouse\Warehouse;

use App\Models\Inventory;
use App\Models\Workarea;
use Darryldecode\Cart\Cart as CartCart;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;
use Livewire\WithPagination;

class EntriesController extends Component
{
    use WithPagination;

    public $proveedor, $nomComer, $fecha, $fol_entrada, $factura, $nFactura, $ordenCompra, $depSolici, $nReq, $oSolicitante, $tCompraContrato, $nombrerecibe, $observciones;

    public $search, $article=[], $cantidad=[];

    public $total, $itemsQuantity, $cart=[], $componentName, $selected_id, $pagination=10;

    protected $listeners = [
        'removeItems' => 'removeItems',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];

    public function mount()
    {
        $this->search = '';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->componentName = 'BUSQUEDA ARTICULOS';
        $this->selected_id = null;
    }

    public function render()
    {
        if ($this->search)
        {
            $data = Inventory::where('descripcion', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }
        else
        {
            $data = Inventory::orderBy('id', 'asc')->paginate($this->pagination);
        }

        $deptos = Workarea::all();
        $this->cart = Cart::getContent()->sortBy('name');

        return view('livewire.storehouse.warehouse.component',
            [
                'deptos' => $deptos,
                'cart' => $this->cart,
                'data' => $data,
            ]
        )
                ->extends('layouts.themes.app')
                ->section('content');
    }

    public function resetUI()
    {
        $this->search = '';
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->componentName = 'BUSQUEDA ARTICULOS';
        $this->selected_id = null;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Seek()
    {
        foreach ($this->article as $key => $value) {
            $one = Inventory::find($value);
            Cart::add($one->id, $one->descripcion, $one->costo, 1);
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->cart = Cart::getContent()->sortBy('name');
    }

    Public function Editar()
    {

    }
}
