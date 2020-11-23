<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulo;

use Livewire\WithPagination;

class InventarioComponent extends Component
{

    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search = '';
    public $perPage = '5';

    public function render()
    {   
        return view('livewire.inventario-component', [
        'articulos'=> Articulo::where('Descripcion', 'LIKE', "%{$this->search}%")
        ->paginate($this->perPage)
        ]);

    }
}