<?php

namespace App\Http\Livewire\Storehouse\WarehouseRequest;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

class DeparturesController extends Component
{
    use WithPagination;

    public $search, $article=[], $cantidad=[], $editId, $editName, $editCosto, $editQty;

    public $total, $itemsQuantity, $cart=[], $componentName, $selected_id, $pagination=10;

    protected $rules = [
        'cart' => 'required'
    ];

    protected $messages = [
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
        $this->total = Cart::session(auth()->user()->id)->getTotal();
        $this->itemsQuantity = Cart::session(auth()->user()->id)->getTotalQuantity();
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

        $this->cart = Cart::session(auth()->user()->id)->getContent()->sortBy('name');

        return view('livewire.storehouse.warehouse-request.component',
        [
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
        $this->total = Cart::session(auth()->user()->id)->getTotal();
        $this->itemsQuantity = Cart::session(auth()->user()->id)->getTotalQuantity();
        $this->componentName = 'BUSQUEDA ARTICULOS';
        $this->selected_id = null;
        $this->editId = null;
        $this->editName = null;
        $this->editCosto = null;
        $this->editQty = null;
        $this->resetValidation();
        $this->resetPage();
    }
}
