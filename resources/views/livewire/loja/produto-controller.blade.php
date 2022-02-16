<div>

    {{-- Do your work, then step back. --}}
    <x-slot name="header">

        <h2 class="h4 font-weight-bold">
            {{ __('Produtos') }}
        </h2>

    </x-slot>

    <div class="card">
       <div class="card-header bg-info"></div>
       <div class="card-body">
          <div class="row">


                <div class="form-group col-12 text-center mb-3 text-success">
                    <label class="text-secondary font-weight-bold">
                        @if ($idProduto=="")
                            <strong class="text-primary">{{ __('Cadastrar produtos') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('Alterar produtos ?') }}</strong>
                        @endif
                    </label>
                </div>


              <div class="form-group col-6">
                  <label class="text-secondary">Nome do produto</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('produto') is-invalid @enderror " wire:model.defer="dados.produto" name="produto">
                  @error('produto')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-6">
                  <label class="text-secondary">Selecione a categoria</label>
                  <select class="form-control form-control-sm mb-1 @error('idCategoria') is-invalid @enderror " wire:model.defer="dados.idCategoria" name="idCategoria">
                      <option value="">...</option>
                      @forelse ($categorias as $element)
                          <option value="{{ $element->id }}">{{ $element->nome }}</option>
                      @empty
                          <option value="">Sem categoria</option>
                      @endforelse
                      
                  </select>
                  @error('idCategoria')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-6">
                  <label class="text-secondary">Preço</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('preco') is-invalid @enderror " wire:model.defer="dados.preco" name="preco">
                  @error('preco')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>


              <div class="form-group col-6">
                  <label class="text-secondary">Quantidade</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('quant') is-invalid @enderror " wire:model.defer="dados.quant" name="quant">
                  @error('quant')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-12 ml-0 d-flex justify-content-end mt-2">

                        @if ($idProduto=="")
                            <x-jet-button wire:click="cadastrarProduto()" class="btn btn-block btn-sm"><i class="fa fa-save"></i> cadastrar</x-jet-button>
                        @else
                            <x-jet-button wire:click="alterarProduto()" class="btn btn-block btn-sm"><i class="fa fa-save"></i> Salvar</x-jet-button>
                        @endif

                  

              </div>

          </div>  
       </div>
    </div>

    

    <div class="card">
        <div class="card-header bg-secondary"></div>
        <div class="card-body">

            <div class="form-group col-12 mb-2">
                  <input type="text" class="form-control form-control-sm text-center" placeholder="Procurar..!" wire:model="pesquisar" name="">
              </div>

            <div class="table-responsive">
                <table class="table table-sm table-striped">

                    <tr class="">
                        <td>Nº</td>
                        <td>Produto</td>
                        <td>Categoria</td>
                        <td>Preço</td>
                        <td>Quantidade</td>
                        <td align="center">Opções</td>
                    </tr>
                    @forelse ($produtos as $element)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $element->produto }}</td>
                            <td>{{ $element->idCategoria }}</td>
                            <td>{{ number_format($element->preco, 2, ',', '.') }} Kz</td>
                            <td>{{ $element->quant }}</td>

                            <td align="center">
                                <span class="btn btn-sm" wire:click="editarCategoria({{ $element->id }})">
                                    <i class="fa fa-edit text-success"></i>
                                </span>

                                <span class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmProduto" wire:click="apagarCategoria({{ $element->id }})">
                                    <i class="fa fa-trash text-danger"></i>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center"><span class="text-danger">De momento não existem produtos cadastrados</span></td>
                        </tr>
                    @endforelse
                        

                    


                </table>

               {{ $produtos->links() }}

                
            </div>
        </div>
    </div>

{{-- Modal de confirmação --}}

        <div wire:ignore.self class="modal fade" id="deleteConfirmProduto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h5 class="modal-title text-light" id="exampleModalLabel">
                    Apagar..?
                </h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <i class="fa fa-info-circle"></i> Se apagares poderás perder essa informação permanentemente, tens a certeza?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-block btn-sm btn-danger text-light" wire:click="apagar()"><i class="fa fa-trash"></i> Confirmar</button>
              </div>
            </div>
          </div>
        </div>




</div>


@push('scripts')
     <script>
         window.addEventListener('closeModal', event=>{
            $('#deleteConfirmProduto').modal('hide');
        })
     </script>
@endpush
