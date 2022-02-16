<?php

namespace App\Http\Livewire\Loja;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\categoria;
use DB;
use Livewire\WithPagination;

class CategoriaController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['$refresh'];
    public $dados = [];
    public $categoriaId;
    public $infoCateg = [];
    public $deleteId;



    public function render()
    {

        return view('livewire.loja.categoria', [
            'categorias' => DB::table('categorias')->orderBy('nome', 'asc')->paginate(5),
        ]);
    }


    public function cadastrarCategoria(){

       $cadastrar = Validator::make($this->dados, [
            'nome' => 'required|unique:categorias',
       ],
        $messages = [
            'nome' => 'Preencha o campo da categoria',
        ])->validate();

       categoria::create($cadastrar);
       $this->reset();
       $this->emitTo('livewire.loja.categoria', '$refresh');


    }

    //buscar os dados para editar categoria
    public function editarCategoria($idCategoria){
      $this->categoriaId = $idCategoria;
      $categoria = categoria::find($idCategoria);
      $this->dados = $categoria->toArray();
      $this->infoCateg = $categoria;
    }

    //fazer a alteração dos dados encontrados
    public function alterarCategoria(){

       $cadastrar = Validator::make($this->dados, [
            'nome' => 'required|unique:categorias,nome,'.$this->infoCateg->id,
       ],
        $messages = [
            'nome' => 'Preencha o campo da categoria',
        ])->validate();

       $this->infoCateg->update($cadastrar);
       $this->reset();
       $this->emitTo('livewire.loja.categoria', '$refresh');
    }

    //passa o id no formulario modal
    public function apagarCategoria($id){
        $this->deleteId = $id;
    }

   //apaga as informações do banco de dados
    public function apagar(){
        $apagarCategoria = categoria::find($this->deleteId);
        $apagarCategoria->delete();
        $this->emitTo('livewire.loja.categoria', '$refresh');
        $this->dispatchBrowserEvent('closeModal');
    }

}
