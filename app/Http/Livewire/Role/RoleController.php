<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleController extends Component
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
        $this->componentName = 'SECCIÓN DE ROLES';
    }

    public function render()
    {
        if($this->search){
            $data = Role::where('created_at', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Role::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.role.component', ['data' => $data])
                    ->extends('layouts.themes.app')
                    ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE ROLES';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        Role::create(['name' => $this->name, 'guard_name'=>'web']);

        $this->resetUI();
        session()->flash('message', 'Rol Anexado con exito!');
        $this->emit('item-added', 'Rol registrada Con Éxito!');
    }

    public function Editar($id)
    {
        $rol = Role::find($id);

        $this->name = $rol->name;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $rol = Role::find($this->selected_id);

        $rol->update(['name' => $this->name]);

        $this->resetUI();
        session()->flash('message', 'Rol Editado con exito!');
        $this->emit('item-updated', 'Rol Actualizado');
    }

    public function Destroy(Role $role)
    {
        $role->delete();
        session()->flash('delete', 'Rol Eliminado con exito!');
        $this->emit('item-deleted', 'Rol Eliminado con exito');
        $this->resetUI();
    }
}
