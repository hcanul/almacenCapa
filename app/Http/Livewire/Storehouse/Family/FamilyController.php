<?php

namespace App\Http\Livewire\Storehouse\Family;

use App\Models\Family;
use Livewire\Component;
use Livewire\WithPagination;

class FamilyController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $name;

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
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE FAMILIAS ALMACEN';
    }

    public function render()
    {
        if($this->search){
            $data = Family::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Family::orderBy('id', 'asc')->paginate($this->pagination);
        }



        return view('livewire.storehouse.family.component', [
                    'data' => $data,
                    ])
                    ->extends('layouts.themes.app')
                    ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE FAMEILIAS ALMACEN';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        Family::create(['name' => $this->name, 'guard_name'=>'web']);

        $this->resetUI();
        session()->flash('message', 'Rol Anexado con exito!');
        $this->emit('item-added', 'Rol registrada Con Éxito!');
    }

    public function Editar($id)
    {
        $fam = Family::find($id);

        $this->name = $fam->name;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $fam = Family::find($this->selected_id);

        $fam->update(['name' => $this->name]);

        $this->resetUI();
        session()->flash('message', 'Rol Editado con exito!');
        $this->emit('item-updated', 'Rol Actualizado');
    }

    public function Destroy(Family $family)
    {
        $family->delete();
        session()->flash('delete', 'Rol Eliminado con exito!');
        $this->emit('item-deleted', 'Rol Eliminado con exito');
        $this->resetUI();
    }
}
