<?php

namespace App\Http\Livewire\Storehouse\Measurementunits;

use App\Models\Inventory;
use App\Models\Measurementunits;
use Livewire\Component;
use Livewire\WithPagination;

class MeaserementunitControlle extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $name, $abbr;

    public $pagination = 10;

    protected $rules = [
        'name' => 'required|unique:Measurementunits,name|min:4',
        'abbr' => 'required|unique:Measurementunits,name|max:4'
    ];

    protected $messages =[
        'name.required' => 'El valor es necesario',
        'name.unique' => 'No se puede duplicar el Descripción',
        'name.min' => 'Debe contener minimo 4 caracteres',
        'abbr.required' => 'El valor es necesario',
        'abbr.unique' => 'No se puede duplicar el Abreviatura',
        'abbr.max' => 'Debe contener maximo 4 caracteres',
    ];

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->name = '';
        $this->abbr = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE UNIDADES';
    }

    public function render()
    {
        if($this->search){
            $data = Measurementunits::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Measurementunits::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.storehouse.measurementunits.component', ['data' => $data])
                    ->extends('layouts.themes.app')
                    ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->abbr = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE UNIDADES';
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        $measure = Measurementunits::create(['name' => $this->name, 'abbr' => $this->abbr]);

        $this->resetUI();
        session()->flash('message', "La unidad de medida: $measure->name creada con exito!");
        $this->emit('item-added', 'Unidad registrada Con Éxito!');
    }

    public function Editar($id)
    {
        $measure = Measurementunits::find($id);

        $this->name = $measure->name;
        $this->abbr = $measure->abbr;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $measure = Measurementunits::find($this->selected_id);

        $measure->update(['name' => $this->name, 'abbr' => $this->abbr]);

        $this->resetUI();
        session()->flash('message', 'Unidad Editada con exito!');
        $this->emit('item-updated', 'Unidad Actualizado');
    }

    public function Destroy(Measurementunits $measure)
    {
        $inventory = Inventory::whereMeasurementunitsId($measure)->get();
        if($inventory)
        {
            session()->flash('delete', 'Imposible eliminar esta unidad!');
            $this->emit('item-deleted', 'No se realizo la tarea');
            $this->resetUI();
            return ;
        }
        else{
            $measure->delete();
            session()->flash('delete', 'Rol Eliminado con exito!');
            $this->emit('item-deleted', 'Rol Eliminado con exito');
            $this->resetUI();
        }

    }
}
