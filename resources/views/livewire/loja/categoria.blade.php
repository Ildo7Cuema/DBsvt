<div>

    {{-- Do your work, then step back. --}}
    <x-slot name="header">

        <h2 class="h4 font-weight-bold">
            {{ __('Categorias de produtos') }}
        </h2>

    </x-slot>

    <div class="card">
       <div class="card-header bg-info"></div>
       <div class="card-body">
          <div class="row">
              <div class="form-group col-12">
                  <label class="text-secondary">
                    @if ($categoriaId=='')
                        <strong>Nome de categoria</strong>
                    @else
                        <strong>Alterar nome de categoria</strong>
                    @endif
                  </label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('nome') is-invalid @enderror " wire:model.defer="dados.nome" name="nome">
                  @error('nome')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-12 ml-0 d-flex justify-content-end mt-2">

                  @if ($categoriaId=='')
                      <x-jet-button wire:click="cadastrarCategoria()" class="btn btn-sm"><i class="fa fa-save"></i> cadastrar</x-jet-button>
                  @else
                      {{-- false expr --}}
                      <x-jet-button wire:click="alterarCategoria()" class="btn btn-sm"><i class="fa fa-edit"></i> Salvar</x-jet-button>
                  @endif

              </div>
          </div>  
       </div>
    </div>

    

    <div class="card">
        <div class="card-header bg-secondary"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped">

                    <tr class="">
                        <td>Nº</td>
                        <td>Categorias</td>
                        <td colspan="2" align="center">Opções</td>
                    </tr>
                    @forelse ($categorias as $element)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $element->nome }}</td>

                            <td colspan="2" align="center">
                                <span class="btn btn-sm" wire:click="editarCategoria({{ $element->id }})">
                                    <i class="fa fa-edit text-success"></i>
                                </span>

                                <span class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmCategoria" wire:click="apagarCategoria({{ $element->id }})">
                                    <i class="fa fa-trash text-danger"></i>
                                </span>
                            </td>
                        </tr>
                    @empty
                       <tr>
                           <td colspan="3" class="text-danger" align="center">Nenhuma categoria registada...!</td>
                       </tr>
                    @endforelse
                    


                </table>

                {{ $categorias->links() }}
                
            </div>
        </div>
    </div>

{{-- Modal de confirmação --}}

        <div wire:ignore.self class="modal fade" id="deleteConfirmCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h5 class="modal-title text-light" id="exampleModalLabel">
                    Apagar..?
                </h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <i class="fa fa-info-circle"></i> se apagar, poderá excluir também todos os produtos e outras informações lincadas a essa categoria, tens a certeza?
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
            $('#deleteConfirmCategoria').modal('hide');
        })
     </script>
@endpush
