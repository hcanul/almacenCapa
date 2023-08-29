<?php

namespace App\Http\Livewire\Storehouse\Inventory;

use App\Models\Detsol;
use App\Models\Family;
use App\Models\Inventory;
use App\Models\Measurementunits;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $numInv, $descripcion, $family_id, $measurementunits_id, $existencia, $exisInicial, $costo;

    public $pagination = 10;

    protected $rules = [
        'numInv' => 'required|min:4',
        'descripcion' => 'required',
        'measurementunits_id' => 'required',
        // 'existencia' => 'required',
        'exisInicial' => 'required',
        'costo' => 'required'
    ];

    protected $messages = [
        'numInv.required' => 'El numero de inventario es obligatorio',
        'numInv.min' => 'El numero de inventario debe contener mas de 4 caracteres',
        'descripcion.required' => 'La descripción es obligatoria',
        'measurementunits_id.required' => 'Las unidades de medida son necesarias',
        // 'existencia.required' => 'Debe capturar la existencia',
        'exisInicial.required' => 'Debe Capturar la Existencia Inicial',
        'costo.required' => 'La captura del costo es indispensable'
    ];

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->numInv = null;
        $this->descripcion = null;
        $this->family_id = null;
        $this->measurementunits_id = null;
        $this->existencia = null;
        $this->exisInicial = null;
        $this->costo = null;
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE INVENTARIOS';
    }

    public function render()
    {
        if($this->search){
            $data = Inventory::where('descripcion', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Inventory::orderBy('id', 'asc')->paginate($this->pagination);
        }

        $measures = Measurementunits::all();
        $familias = Family::all();

        return view('livewire.storehouse.inventory.component', [
            'data' => $data,
            'unidades' => $measures,
            'familias' => $familias,
            ])
                ->extends('layouts.themes.app')
                ->section('content');
    }

    public function resetUI()
    {
        $this->numInv = null;
        $this->descripcion = null;
        $this->family_id = null;
        $this->measurementunits_id = null;
        $this->existencia = null;
        $this->exisInicial = null;
        $this->costo = null;
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE INVENTARIOS';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        $article = Inventory::create([
            'numInv' => $this->numInv,
            'descripcion' => $this->descripcion,
            'family_id' => $this->family_id,
            'measurementunits_id' => $this->measurementunits_id,
            'existencia' => $this->existencia,
            'exisInicial' => $this->exisInicial,
            'costo' => $this->costo,
        ]);

        $this->resetUI();
        session()->flash('message', "El Material se agrego con exito: $article->descripcion");
        $this->emit('item-added', 'Rol registrada Con Éxito!');
    }

    public function Editar($id)
    {
        $articulo = Inventory::find($id);

        $this->numInv = $articulo->numInv;
        $this->descripcion = $articulo->descripcion;
        $this->family_id = $articulo->family_id;
        $this->measurementunits_id = $articulo->measurementunits_id;
        $this->existencia = $articulo->existencia;
        $this->exisInicial = $articulo->exisInicial;
        $this->costo = $articulo->costo;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $inventor = Inventory::find($this->selected_id);

        $inventor->update([
            'numInv' => $this->numInv,
            'descripcion' => $this->descripcion,
            'family_id' => $this->family_id,
            'measurementunits_id' => $this->measurementunits_id,
            'existencia' => 0,
            'exisInicial' => $this->exisInicial,
            'costo' => $this->costo,
        ]);

        $this->resetUI();
        session()->flash('message', 'Articulo Editado con exito!');
        $this->emit('item-updated', 'Articulo Actualizado');
    }

    public function Destroy(Inventory $inventory)
    {
        $detalles = Detsol::find($inventory->id);

        if($detalles)
        {
            session()->flash('delete', 'Imposible Eliminarlo con exito!');
            $this->emit('item-deleted', 'Rol Eliminado con exito');
            $this->resetUI();
            return ;
        }
        else
        {
            $inventory->delete();
            session()->flash('delete', 'Rol Eliminado con exito!');
            $this->emit('item-deleted', 'Rol Eliminado con exito');
            $this->resetUI();
        }
    }
}
