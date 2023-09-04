<?php

namespace App\Http\Livewire\Storehouse\WarehouseRequest;

use App\Models\Boss;
use App\Models\Demands;
use App\Models\DepartamentBoss;
use App\Models\Detsol;
use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

class DeparturesController extends Component
{
    use WithPagination;

    public $search, $article=[], $cantidad=[], $editId, $editName, $editCosto, $editQty;

    public $total, $itemsQuantity, $cart=[], $componentName, $selected_id, $pagination=10, $observaciones;

    protected $rules = [
        'cart' => 'required',
        'observaciones' => 'required'
    ];

    protected $messages = [
        'cart.required' => 'Debe capturar articulos a la lista',
        'observaciones.required' => 'Debe Capturar las observaciones'
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

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        $requerimiento = Demands::create([
            'user_id' => Auth()->user()->id,
            'total' => Cart::session(auth()->user()->id)->getTotal(),
            'pfstatus' => 'Pendiente',
            'sfstatus' => 'Pendiente',
            'status' => 'Pendiente',
            'obserMAt' => '',
            'obserSub' => '',
            'actividad' => $this->observaciones,
            'boss_id' => DepartamentBoss::where('name', 'like', '%'. Auth()->user()->name . '%')->get()[0]->boss_id,
        ]);

        $this->cart = Cart::session(auth()->user()->id)->getContent()->sortBy('name');

        foreach ($this->cart as $key => $value) {
            Detsol::create([]);
        }
    }

    public function imprimir()
    {
        return redirect("requerimiento/1", ['target' => '_blank']);
    }
}
