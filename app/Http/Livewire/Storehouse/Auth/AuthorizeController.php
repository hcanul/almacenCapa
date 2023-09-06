<?php

namespace App\Http\Livewire\StoreHouse\Auth;

use Livewire\Component;

class AuthorizeController extends Component
{
    public $search, $selected_id, $pageTitle, $componentName;

    public $detalles;

    public $pagination = 10;

    public function render()
    {
        return view('livewire.storehouse.auth.component')
        ->extends('layouts.themes.app')
        ->section('content');
    }
}
