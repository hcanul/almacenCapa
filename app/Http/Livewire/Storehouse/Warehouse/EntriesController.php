<?php

namespace App\Http\Livewire\Storehouse\Warehouse;

use App\Models\Inventory;
use App\Models\WarehouseEntry;
use App\Models\WarehouseProduct;
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
        'nomComer.required' => 'El Campo es obligatorio',
        'nomComer.min' => 'El Nombre Comercial debe contener mas de 4 caracteres',
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
        $this->proveedor = null;
        $this->nomComer = null;
        $this->fecha = null;
        $this->fol_entrada = null;
        $this->factura = null;
        $this->nFactura = null;
        $this->ordenCompra = null;
        $this->depSolici = null;
        $this->nReq = null;
        $this->oSolicitante = null;
        $this->tCompraContrato = null;
        $this->nombrerecibe = null;
        $this->observaciones = null;
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

    public function Cancelar()
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
        $this->proveedor = null;
        $this->nomComer = null;
        $this->fecha = null;
        $this->fol_entrada = null;
        $this->factura = null;
        $this->nFactura = null;
        $this->ordenCompra = null;
        $this->depSolici = null;
        $this->nReq = null;
        $this->oSolicitante = null;
        $this->tCompraContrato = null;
        $this->nombrerecibe = null;
        $this->observaciones = null;
        $this->article = [];
        $this->cantidad = [];
        $this->editId = null;
        $this->editName = null;
        $this->editCosto = null;
        $this->editQty = null;
        $this->resetValidation();
        $this->resetPage();
        Cart::clear();
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

    public function removeItems($id)
    {
        $this->cart = Cart::remove($id);
    }

    public function Store()
    {
        // $this->validate($this->rules, $this->messages);

        // $entrada = WarehouseEntry::create([
        //     'proveedor' => $this->proveedor,
        //     'nomComer' => $this->nomComer,
        //     'fecha' => $this->fecha,
        //     'fol_entrada' => $this->fol_entrada,
        //     'factura' => $this->factura,
        //     'nFactura' => $this->nFactura,
        //     'ordenCompra' => $this->ordenCompra,
        //     'depSolici' => $this->depSolici,
        //     'nReq' => $this->nReq,
        //     'oSolicitante' => $this->oSolicitante,
        //     'tCompraContrato' => $this->tCompraContrato,
        //     'nombrerecibe' => $this->nombrerecibe,
        //     'observaciones' => $this->observaciones,
        //     'total' => $this->total
        // ]);

        // foreach ($this->cart as $value) {
        //     $inventa = Inventory::find($value['id']);
        //     WarehouseProduct::create([
        //         'warehouse_entries_id' => $entrada->id,
        //         'inventory_id' => $value['id'],
        //         'numInv' => $inventa->numInv,
        //         'catidad' => $value['quantity'],
        //         'measurementunits_id' => $inventa->measurementunits_id,
        //         'descripcion' => $value['name'],
        //         'pUnit' => $value['price'],
        //         'total' => $value['quantity'] * $value['price'],
        //         'ordenCompra' => $entrada->ordenCompra
        //     ]);
        //     $inventa->Update(['existencia'=> $inventa->existencia + $value['quantity']]);
        // }

        // $this->resetUI();
        // $this->Cancelar();
        // session()->flash('message', "Entrada Generada Con exito");
        // $this->emit('item-added', 'Entrada Generada Con exito!');
        // return redirect("Almacen/entrada/$entrada->id", ['target' => '_blank']);
        return redirect("Almacen/entrada/9", ['target' => '_blank']);

    }

}
