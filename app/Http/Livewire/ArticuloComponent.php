<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Articulo;

use Livewire\WithPagination;

class ArticuloComponent extends Component
{

    use WithPagination;

    protected $queryString = ['search' => ['except' => '']];

    public $search = '';
    public $perPage = '5';

    public $modalFormVisible = false;

    public function render()
    {   
        return view('livewire.articulo-component', [
        'articulos'=> Articulo::where('Descripcion', 'LIKE', "%{$this->search}%")
        ->paginate($this->perPage)
        ]);

    }
    
    /**
     * Función que muestra el modal
     *
     * @return void
     */
    public function createShowModal(){
        $this->modalFormVisible = true;
    }


}
