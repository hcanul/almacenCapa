<?php

namespace App\Http\Livewire\Storehouse\Warehouse;

use App\Models\WarehouseEntry;
use App\Models\WarehouseProduct;
use Livewire\Component;
use Livewire\WithPagination;

class ReprinterController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $detalles;

    public $pagination = 10;

    protected $rules = [
        'name' => 'required|unique:roles,name|min:4',
    ];

    protected $messages =[
        'name.required' => 'El valor es necesario',
        'name.unique' => 'No se puede duplicar el Rol',
        'name.min' => 'Debe contener minimo 4 caracteres',
    ];

    protected $listeners = [
        'printerRow' => 'Printer',
    ];

    public function mount()
    {
        $this->detalles = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE ENTRADAS';
    }


    public function render()
    {
        if($this->search){
            $data = WarehouseEntry::where('fol_entrada', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = WarehouseEntry::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.storehouse.warehouse.reprinter.component',
        [
            'data' => $data
        ]
        )
            ->extends('layouts.themes.app')
            ->section('content');
    }

    public function resetUI()
    {
        $this->emit("showDialog");
    }

    public function Ver($id)
    {
        $this->detalles = WarehouseProduct::whereWarehouseEntriesId($id)->get();
    }

    public function Printer($id)
    {
        return redirect("Almacen/entrada/$id", ['target' => '_blank']);
    }
}
