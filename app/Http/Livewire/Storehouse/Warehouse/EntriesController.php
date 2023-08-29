<?php

namespace App\Http\Livewire\Storehouse\Warehouse;

use App\Models\Inventory;
use App\Models\Workarea;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;
use Livewire\WithPagination;

class EntriesController extends Component
{
    use WithPagination;

    public $proveedor, $nomComer, $fecha, $fol_entrada, $factura, $nFactura, $ordenCompra, $depSolici, $nReq, $oSolicitante, $tCompraContrato, $nombrerecibe, $observaciones;

    public $search, $article=[], $cantidad=[], $editId, $editName, $editCosto, $editQty;

    public $total, $itemsQuantity, $cart=[], $componentName, $selected_id, $pagination=10;

    protected $rules = [
        'proveedor' => 'required|min:4',
        'nomComer' => 'required|min:4',
        'fecha' => 'required',
        'fol_entrada' => 'required',
        'factura' => 'required',
        'nFactura' => 'required',
        'ordenCompra' => 'required',
        'depSolici' => 'required',
        'nReq' => 'required',
        'oSolicitante' => 'required',
        'tCompraContrato' => 'required',
        'nombrerecibe' => 'required',
        'observaciones' => 'required',
        'cart' => 'required'
    ];
    protected $messages = [
        'proveedor.required' => 'El proveedor es obligatorio capturarlo',
        'proveedor.min' => 'El Nombre del Proveedor debe contener mas de 4 caracteres',
        'nomComer.min' => 'El Nombre Comercial debe contener mas de 4 caracteres',
        'nomComer.required' => 'El Campo es obligatorio',
        'fecha.required' => 'El Campo es obligatorio',
        'fol_entrada.required' => 'El Campo es obligatorio',
        'factura.required' => 'El Campo es obligatorio',
        'nFactura.required' => 'El Campo es obligatorio',
        'ordenCompra.required' => 'El Campo es obligatorio',
        'depSolici.required' => 'El Campo es obligatorio',
        'nReq.required' => 'El Campo es obligatorio',
        'oSolicitante.required' => 'El Campo es obligatorio',
        'tCompraContrato.required' => 'El Campo es obligatorio',
        'nombrerecibe.required' => 'El Campo es obligatorio',
        'observaciones.required' => 'El Campo es obligatorio',
        'cart.required' => 'Debe capturar articulos a la lista'
    ];

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
        $this->editId = null;
        $this->editName = null;
        $this->editCosto = null;
        $this->editQty = null;
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
        $this->editId = null;
        $this->editName = null;
        $this->editCosto = null;
        $this->editQty = null;
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

    public function Editar($id)
    {
        $this->componentName = 'EDITAR ARTICULOS';
        $this->selected_id = $id;
        $data = Cart::get($id);
        $this->editId = $data->id;
        $this->editName = $data->name;
        $this->editCosto = $data->price;
        $this->editQty = $data->quantity;
    }

    public function Update()
    {
        Cart::update($this->selected_id, array('quantity' => $this->editQty));
        $this->resetUI();
        session()->flash('message', "Articulo Modificado con exito");
        $this->emit('item-updated', 'Articulo modificado exitosamente!');
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);
    }
}
