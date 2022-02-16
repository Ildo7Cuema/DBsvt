<?php

namespace App\Http\Livewire\Loja;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\categoria;
use App\Models\admin\produto;
use DB;
use Livewire\WithPagination;

class ProdutoController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dados = [];
    public $dadosEdit = [];
    protected $listeners = ['$refresh'];

    public $idProduto;
    public $pesquisar;


    public function render()
    {
        $procurar = "%".$this->pesquisar."%";

        return view('livewire.loja.produto-controller', [
            'categorias' => DB::table('categorias')->orderBy('nome', 'asc')->get(),
            'produtos' => DB::table('produtos')->orderBy('produto','asc')
            ->where('produto', 'LIKE', $procurar)
            ->orWhere('idCategoria', 'LIKE', $procurar)
            ->paginate(5),
        ]);
    }


    public function cadastrarProduto(){
        $produtos = Validator::make($this->dados, [
            'produto'=>'bail|required|unique:produtos',
            'idCategoria'=>'bail|required',
            'preco'=>'bail|required',
            'quant'=>'bail|required',
        ],
        $messages = [
            'produto.required'=>'O campo produto é obrigado',
            'idCategoria.required'=>'O campo categoria é obrigatório',
            'preco.required'=>'O campo preço é obrigatório',
            'quant.required'=>'O Campo para a quantidade é obrigatório',
        ])->validate();

        produto::create($produtos);
        $this->reset();
        $this->emitTo('loja.produto-controller', '$refresh');
    }

    //Buscar dados no banco para editar
    public function editarCategoria($id){
        $prod = produto::find($id);
        $this->dados = $prod->toArray();
        $this->dadosEdit = $prod;
        $this->idProduto = $id;
    }

    //actualizar dados no banco
    public function alterarProduto(){

        $produtos = Validator::make($this->dados, [
            'produto'=>'bail|required|unique:produtos,produto,'.$this->dadosEdit->id,
            'idCategoria'=>'bail|required',
            'preco'=>'bail|required',
            'quant'=>'bail|required',
        ],
        $messages = [
            'produto.required'=>'O campo produto é obrigado',
            'idCategoria.required'=>'O campo categoria é obrigatório',
            'preco.required'=>'O campo preço é obrigatório',
            'quant.required'=>'O Campo para a quantidade é obrigatório',
        ])->validate();

        $this->dadosEdit->update($produtos);
        $this->reset();
        $this->emitTo('loja.produto-controller', '$refresh');

    }

    //Apagar dados do produto
    public function apagarCategoria($id){
        $this->idProduto = $id;
    }

    public function apagar(){
        produto::find($this->idProduto)->delete();
        $this->emitTo('loja.produto-controller', '$refresh');
        $this->dispatchBrowserEvent('closeModal');
    }


}
