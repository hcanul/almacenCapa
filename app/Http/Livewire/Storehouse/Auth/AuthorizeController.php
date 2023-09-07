<?php

namespace App\Http\Livewire\StoreHouse\Auth;

use App\Models\Demands;
use App\Models\Detsol;
use Livewire\Component;

class AuthorizeController extends Component
{
    public $search, $selected_id, $pageTitle, $componentName;

    public $detalles;

    public $pagination = 10;

    protected $listeners = [
        'cancelarReq' => 'Cancelar',
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
            $data = Demands::where('fol_entrada', 'like', '%' . $this->search .'%')->paginate($this->pagination);
        }else{
            $data = Demands::orderBy('id', 'asc')->paginate($this->pagination);
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
        $this->detalles = Detsol::whereDemandId($id)->get();
        $this->detalles->load('inventory');
    }

    public function Cancelar($id)
    {
        dd($id[0], $id[1]);
    }
}
