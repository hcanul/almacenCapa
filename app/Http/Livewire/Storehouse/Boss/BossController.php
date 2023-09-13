<?php

namespace App\Http\Livewire\Storehouse\Boss;

use App\Models\Boss;
use App\Models\Demands;
use App\Models\Job;
use App\Models\Workarea;
use Livewire\Component;
use Livewire\WithPagination;

class BossController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $name, $job_id, $workarea_id;

    public $pagination = 10;

    protected $rules = [
        'name' => 'required|unique:bosses,name|min:6',
        'job_id' => 'required',
        'workarea_id' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Debe capturar el Nombre',
        'name.unique' => 'El Nombre no puede repetirse',
        'name.min' => 'El nombre debe capturarse Completo',
        'job_id.required' => 'Debe capturar el Cargo',
        'workarea_id.required' => 'Debe capturar el Area',
    ];

    protected $listeners = [
        'deleteRow' => 'Destroy',
    ];

    public function mount()
    {
        $this->name = '';
        $this->job_id = '';
        $this->workarea_id = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE CARGOS';
    }

    public function render()
    {
        if($this->search){
            $data = Boss::where('name', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Boss::orderBy('id', 'asc')->paginate($this->pagination);
        }
        $jobs = Job::all();
        $works = Workarea::all();

        return view('livewire.storehouse.boss.component', [
            'data' => $data,
            'jobs' => $jobs,
            'works' => $works,
            ])
                ->extends('layouts.themes.app')
                ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->job_id = '';
        $this->workarea_id = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE CARGOS';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Store()
    {
        $this->validate($this->rules, $this->messages);

        $boss = Boss::create([
            'name' => $this->name,
            'job_id' => $this->job_id,
            'workarea_id' => $this->workarea_id
        ]);

        session()->flash('message', "Se creo con exito el puesto asignado a: $boss->name");
        $this->resetUI();
        $this->emit('item-added', 'Cargo creado Con Éxito!');
    }

    public function Editar(Boss $boss)
    {
        $this->name = $boss->name;
        $this->job_id = $boss->job_id;
        $this->workarea_id = $boss->workarea_id;

        $this->selected_id = $boss->id;
    }

    public function Update()
    {
        $this->validate($this->rules, $this->messages);

        $boss = Boss::find($this->selected_id);

        $boss->update([
            'name' => $this->name,
            'job_id' => $this->job_id,
            'workarea_id' => $this->workarea_id
        ]);

        session()->flash('message', 'El Cargo se edito con exito!');
        $this->resetUI();
        $this->emit('item-updated', 'Cargo Actualizado');
    }

    public function Destroy(Boss $boss)
    {
        $demands = Demands::whereBossId($boss)->get();
        if($demands)
        {
            session()->flash('delete', 'El Cargo No se puede eliminar, ya que tiene solicitudes relacionadas');
            return;
        }
        else{
            $boss->delete();
            session()->flash('delete', 'Cargo Eliminado con exito!');
            $this->emit('item-deleted', 'Cargo Eliminado con exito');
            $this->resetUI();
        }
    }
}
