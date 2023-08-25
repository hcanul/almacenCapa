<?php

namespace App\Http\Livewire\Asignar;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AsignarController extends Component
{
    use WithPagination;

    public $role, $pageTitle, $componentName, $permisosSelected = [], $old_permissions = [];

    private $pagination = 10;

    protected $listeners = ['revokeall' => 'RemoveAll'];

    public function mount()
    {
        $this->pageTitle = 'LLISTADO';
        $this->componentName = 'ASIGNACIÓN DE PERMISOS';
    }

    public function render()
    {
        $permisos = Permission::select('name', 'id', DB::raw("0 as checked"))
                    ->orderBy('name', 'asc')
                    ->paginate($this->pagination);

        if($this->role != null || $this->role == 'Elegir')
        {
            $list = Permission::join('role_has_permissions as rp', 'rp.permission_id', 'permissions.id')
            ->where('role_id', $this->role)->pluck('permissions.id')->toArray();

            $this->old_permissions = $list;
        }

        if($this->role != null || $this->role == 'Elegir')
        {
            foreach ($permisos as $permiso) {
                $role = Role::find($this->role);
                try {
                    $tienePermiso = $role->hasPermissionTo($permiso->name);
                } catch (\Throwable $th) {
                    $tienePermiso = false;
                }

                if($tienePermiso)
                {
                    $permiso->checked = 1;
                }
            }
        }

        return view('livewire.asignar.component', ['permisos'=> $permisos, 'roles' => Role::orderBy('id', 'asc')->get()])
                ->extends('layouts.themes.app')
                ->section('content');
    }

    public function RemoveAll()
    {
        if ($this->role == null || $this->role == 'Elegir')
        {

            session()->flash('delete', 'Selecciones un Rol Valido');
            return;
        }

        $role = Role::find($this->role);
        $role->syncPermissions([0]);
        session()->flash('message', "Se revocaron todos los permisos al Rol: $role->name");
    }

    public function SyncAll()
    {
        if ($this->role == null || $this->role == 'Elegir')
        {

            session()->flash('delete', 'Selecciones un Rol Valido');
            return;
        }

        $role = Role::find($this->role);
        $permissions = Permission::pluck('id')->toArray();
        $role->syncPermissions($permissions);
        session()->flash('message', "Se Sincronizaron todos los permisos al Rol: $role->name");
    }

    public function SyncPermiso($state, $permisoName)
    {
        if ($this->role !== null || $this->role !== 'Elegir')
        {
            $roleName = Role::find($this->role);
            if ($state)
            {
                try {
                    $roleName->givePermissionTo($permisoName);
                    session()->flash('message', 'Permiso Asignado Correctamente');
                } catch (\Throwable $th) {
                    session()->flash('delete', 'Debe elegir un Rol Valido');
                }
            }
            else{
                try {
                    $roleName->revokePermissionTo($permisoName);
                    session()->flash('delete', 'Permiso Revocado Correctamente');
                } catch (\Throwable $th) {
                    session()->flash('delete', 'Debe elegir un Rol Valido');
                }
            }
        }
        else
        {
            session()->flash('delete', 'elige un Rol Valido');
        }

    }
}
