<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $name, $email, $password, $password_confirmation, $status, $profile;

    public $pagination = 10;

    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email|unique:users',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6',
        'status' => 'required|not_in:Elegir',
        'profile' => 'required|not_in:Elegir',
    ];
    protected $rules2 = [
        'name' => 'required|min:4',
        'email' => 'required|email',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6',
        'status' => 'required|not_in:Elegir',
        'profile' => 'required|not_in:Elegir',
    ];

    protected $messages =[
        'name.required' => 'El Nombre es Requerido',
        'name.min' => 'Debe contener minimo 4 caracteres',
        'email.required'=>'El Email es requerido.',
        'email.email' => 'El Email debe tener formato de email',
        'email.unique' => 'El correo ya existe en la base de datos',
        'password.required' => 'Debe capturar el Password',
        'password.min' => 'El Password debe contener al menos 6 caracteres',
        'passwor.confirmed' => 'Debe coincidir el correo',
        'password_confirmation.min' => 'El Password debe contener al menos 6 caracteres',
        'status.required' => 'Debe seleccionar una Estatus para este usuario',
        'status.not_in' => 'Selecciones un Estado Valido',
        'profile.required'=> 'Seleccione un Rol para este usuario',
        'profile.not_in' => 'Seleccione un Perfil Valido',
    ];
    protected $messages2 =[
        'name.required' => 'El Nombre es Requerido',
        'name.min' => 'Debe contener minimo 4 caracteres',
        'email.required'=>'El Email es requerido.',
        'email.email' => 'El Email debe tener formato de email',
        'password.required' => 'Debe capturar el Password',
        'password.min' => 'El Password debe contener al menos 6 caracteres',
        'passwor.confirmed' => 'Debe coincidir el correo',
        'password_confirmation.min' => 'El Password debe contener al menos 6 caracteres',
        'status.required' => 'Debe seleccionar una Estatus para este usuario',
        'status.not_in' => 'Selecciones un Estado Valido',
        'profile.required'=> 'Seleccione un Rol para este usuario',
        'profile.not_in' => 'Seleccione un Perfil Valido',
    ];

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->status = 'Elegir';
        $this->profile = 'Elegir';
        $this->search = null;
        $this->selected_id = null;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN USUARIOS';
    }

    public function render()
    {
        if ($this->search)
        {
            $data = User::where('name', 'like', '%' . $this->search . '%' )->paginate($this->pagination);
        }
        else
        {
            $data = User::orderBy('id', 'asc')->paginate($this->pagination);
        }

        return view('livewire.user.component', ['data' => $data, 'roles' => Role::orderBy('name', 'asc')->get()])
                ->extends('layouts.themes.app')
                ->section('content');
    }

    public function resetUI()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->status = 'elegir';
        $this->profile = 'Elegir';
        $this->search = null;
        $this->selected_id = null;
        $this->pageTitle = 'LISTADO';
        $this->componentName = 'SECCIÓN USUARIOS';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        $user = User::create([
            'name' => $this->name,
            'email' =>$this->email,
            'password'=> Hash::make($this->password),
            'profile' => $this->profile,
            'status' => $this->status,
        ]);
        $user->syncRoles($this->profile);

        $this->resetUI();
        session()->flash('message', 'Usuario Anexado con exito!');
        $this->emit('item-added', 'Usuario registrada Con Éxito!');

    }

    public function Editar($id)
    {
        $user = User::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->profile = $user->profile;
        $this->status =  $user->status;

        $this->selected_id = $id;
    }

    public function Update()
    {
        $this->validate($this->rules2, $this->messages2);

        $user = User::find($this->selected_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'profile' => $this->profile,
            'status' => $this->status,
        ]);
        $user->syncRoles($this->profile);

        $this->resetUI();
        session()->flash('message', 'Usuario Editado con exito!');
        $this->emit('item-updated', 'Usuario Actualizado');
    }

    public function Destroy(User $user)
    {
        $user->delete();
        session()->flash('delete', 'Usuario Eliminado con exito!');
        $this->emit('item-deleted', 'Usuario Eliminado con exito');
        $this->resetUI();
    }
}
