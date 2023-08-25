<?php

namespace App\Http\Livewire\Permisos;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermisosController extends Component
{
    use WithPagination;

    public $name, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 10;

    protected $rules = [
        'name' => 'required|unique:permissions,name|min:4',
    ];

    protected $messages =[
        'name.required' => 'El valor es necesario',
        'name.unique' => 'No se puede duplicar el Permiso',
        'name.min' => 'Debe contener minimo 4 caracteres',
    ];

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE PERMISOS';
    }

    public function render()
    {
        if($this->search){
            $data = Permission::where('created_at', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Permission::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.permisos.component', ['data' => $data])
                    ->extends('layouts.themes.app')
                    ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE PERMISOS';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        Permission::create(['name' => $this->name, 'guard_name'=>'web']);

        $this->resetUI();
        session()->flash('message', 'Permiso Anexado con exito!');
        $this->emit('item-added', 'Permiso registrada Con Éxito!');
    }

    public function Editar($id)
    {
        $permiso = Permission::find($id);

        $this->name = $permiso->name;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $permiso = Permission::find($this->selected_id);

        $permiso->update(['name' => $this->name]);

        $this->resetUI();
        session()->flash('message', 'Permiso Editado con exito!');
        $this->emit('item-updated', 'Permiso Actualizado');
    }

    public function Destroy(Permission $permiso)
    {
        $rolesCount = Permission::find($permiso->id)->getRoleNames()->count();
        if($rolesCount > 0)
        {
            $this->emit('permiso-error', 'No se puede eliminar el permiso porque tiene rol asociado');
            session()->flash('delete', 'No se puede eliminar el permiso porque tiene rol asociado');
            return;
        }
        $permiso->delete();
        session()->flash('delete', 'Permiso Eliminado con exito!');
        $this->emit('item-deleted', 'Permiso Eliminado con exito');
        $this->resetUI();
    }
}
