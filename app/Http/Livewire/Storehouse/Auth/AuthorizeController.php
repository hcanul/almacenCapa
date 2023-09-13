<?php

namespace App\Http\Livewire\StoreHouse\Auth;

use App\Models\Demands;
use App\Models\Detsol;
use Livewire\Component;
use Livewire\WithPagination;


class AuthorizeController extends Component
{
    use WithPagination;

    public $search, $selected_id, $pageTitle, $componentName;

    public $detalles;

    public $pagination = 10;

    protected $listeners = [
        'cancelarReq' => 'Cancelar',
        'approvedReq' => 'Aprobar',
        'PrintedReq' => 'Printer'
    ];

    public function mount()
    {
        $this->detalles = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE DETALLES';
    }

    public function render()
    {
        if (auth()->user()->profile == "SubGerente")
        {
            $data = strlen($this->search) > 0 ? Demands::where('created_at', 'like', '%' . $this->search .'%')->wherePfstatus('Aprobado')->whereSfstatus('Pendiente')->paginate($this->pagination):
                                    Demands::orderBy('id', 'asc')->wherePfstatus('Aprobado')->whereSfstatus('Pendiente')->paginate($this->pagination);
        }
        else
        {
            $data = strlen($this->search) > 0 ? Demands::where('created_at', 'like', '%' . $this->search .'%')->wherePfstatus('Pendiente')->paginate($this->pagination):
                                    Demands::orderBy('id', 'asc')->wherePfstatus('Pendiente')->paginate($this->pagination);
        }

        return view('livewire.storehouse.auth.component',
            [
                'data' => $data
            ]
        )
        ->extends('layouts.themes.app')
        ->section('content');
    }

    public function Ver($id)
    {
        $this->pageTitle = 'Detalles';
        $this->detalles = Detsol::whereDemandId($id)->get();
        $this->detalles->load('inventory');
    }

    public function Cancelar($id)
    {   auth()->user()->profile == "SubGerente" ? Demands::find($id[0])->update(['sfstatus' => 'Cancelado', 'obserMat' => $id[1]]) : Demands::find($id[0])->update(['pfstatus' => 'Cancelado', 'obserMat' => $id[1]]);
        //Demands::find($id[0])->update(['pfstatus' => 'Cancelado', 'obserMat' => $id[1]]);
        $this->resetUI();
        session()->flash('delete', "Requerimiento Núm: $id[0] Cancelado con exito!");
        $this->emit('item-added', 'Requerimiento Cancelado Con Éxito!');
    }

    public function Aprobar($id)
    {
        auth()->user()->profile == "SubGerente" ? Demands::find($id)->update(['sfstatus' => 'Aprobado']) : Demands::find($id)->update(['pfstatus' => 'Aprobado']);
        //Demands::find($id)->update(['pfstatus' => 'Aprobado']);
        $this->resetUI();
        session()->flash('message', "Requerimiento Núm: $id Aprobado con exito!");
        $this->emit('item-added', 'Requerimiento Aprobado Con Éxito!');
    }

    public function resetUI()
    {
        $this->detalles = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->pageTitle = 'Listado';
        $this->componentName = 'SECCIÓN DE DETALLES';
        $this->resetValidation();
        $this->resetPage();
    }

    public function Printer($id)
    {
        dd($id);
    }
}
