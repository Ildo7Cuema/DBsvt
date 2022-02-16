<?php

namespace App\Http\Livewire\Loja;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\categoria;
use App\Models\admin\produto;
use App\Models\admin\funcionario;
use DB;
use Livewire\WithPagination;

class FuncionarioController extends Component
{
     use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dados = [];
    public $dadosEdit = [];
    protected $listeners = ['$refresh'];

    public $idFuncionario;
    public $pesquisar;

    public function render()
    {
        $procurar = "%".$this->pesquisar."%";

        return view('livewire.loja.funcionario-controller', [
            'funcionarios' => DB::table('funcionarios')->orderBy('nome')
            ->where('nome', 'LIKE', $procurar)
            ->paginate(5),
        ]);
    }


     public function cadastrarFuncionario(){
        $funcionarios = Validator::make($this->dados, [
            'nome'=>'bail|required|unique:funcionarios',
            'telefone'=>'bail|required',
            'endereco'=>'bail|required',
            'email'=>'bail|required|unique:funcionarios',
        ],
        $messages = [
            'nome.required'=>'O campo nome é obrigado',
            'telefone.required'=>'O campo telefone é obrigatório',
            'endereco.required'=>'O campo endereço é obrigatório',
            'email.required'=>'O Campo e-mail é obrigatório',
        ])->validate();

        funcionario::create($funcionarios);
        $this->reset();
        $this->emitTo('loja.funcionario-controller', '$refresh');
    }

    //Buscar dados no banco para editar
    public function editarFuncionario($id){
        $prod = funcionario::find($id);
        $this->dados = $prod->toArray();
        $this->dadosEdit = $prod;
        $this->idFuncionario = $id;
    }

    //actualizar dados no banco
    public function alterarFuncionario(){

        $funcionarios = Validator::make($this->dados, [
            'nome'=>'bail|required|unique:funcionarios,nome,'.$this->dadosEdit->id,
            'telefone'=>'bail|required',
            'endereco'=>'bail|required',
            'email'=>'bail|required|unique:funcionarios,email,'.$this->dadosEdit->id,
        ],
        $messages = [
            'nome.required'=>'O campo nome é obrigado',
            'telefone.required'=>'O campo telefone é obrigatório',
            'endereco.required'=>'O campo endereço é obrigatório',
            'email.required'=>'O Campo e-mail é obrigatório',
        ])->validate();

        $this->dadosEdit->update($funcionarios);
        $this->reset();
        $this->emitTo('loja.funcionario-controller', '$refresh');

    }

    //Apagar dados do funcionario
    public function apagarFuncionario($id){
        $this->idFuncionario = $id;
    }

    public function apagar(){
        funcionario::find($this->idFuncionario)->delete();
        $this->emitTo('loja.funcionario-controller', '$refresh');
        $this->dispatchBrowserEvent('closeModal');
    }


}
