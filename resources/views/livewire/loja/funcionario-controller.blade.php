<div>
     {{-- Do your work, then step back. --}}
    <x-slot name="header">

        <h2 class="h4 font-weight-bold">
            {{ __('Funcionários') }}
        </h2>

    </x-slot>

    <div class="card">
       <div class="card-header bg-info"></div>
       <div class="card-body">
          <div class="row">


                <div class="form-group col-12 text-center mb-3 text-success">
                    <label class="text-secondary font-weight-bold">
                        @if ($idFuncionario=="")
                            <strong class="text-primary">{{ __('Cadastrar funcionário') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('Alterar funcionário ?') }}</strong>
                        @endif
                    </label>
                </div>


              <div class="form-group col-6">
                  <label class="text-secondary">Nome do funcionario</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('nome') is-invalid @enderror " wire:model.defer="dados.nome" name="nome">
                  @error('nome')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-6">
                  <label class="text-secondary">Nº de telefone</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('telefone') is-invalid @enderror " wire:model.defer="dados.telefone" name="telefone" name="">
                  @error('telefone')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-6">
                  <label class="text-secondary">Endereço</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('endereco') is-invalid @enderror " wire:model.defer="dados.endereco" name="endereco">
                  @error('endereco')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>


              <div class="form-group col-6">
                  <label class="text-secondary">E-mail</label>
                  <input type="text" class="form-control form-control-sm mb-1 @error('email') is-invalid @enderror " wire:model.defer="dados.email" name="email">
                  @error('email')
                       <span class="text-danger small">{{ $message }}</span>
                  @enderror
              </div>

              <div class="form-group col-12 ml-0 d-flex justify-content-end mt-2">

                        @if ($idFuncionario=="")
                            <x-jet-button wire:click="cadastrarFuncionario()" class="btn btn-block btn-sm"><i class="fa fa-save"></i> cadastrar</x-jet-button>
                        @else
                            <x-jet-button wire:click="alterarFuncionario()" class="btn btn-block btn-sm"><i class="fa fa-save"></i> Salvar</x-jet-button>
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
                        <td>Funcionarios</td>
                        <td>Telefone</td>
                        <td>Endereço</td>
                        <td>E-mail</td>
                        <td align="center">Opções</td>
                    </tr>
                    @forelse ($funcionarios as $element)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $element->nome }}</td>
                            <td>{{ $element->telefone }}</td>
                            <td>{{ $element->endereco }} Kz</td>
                            <td>{{ $element->email }}</td>

                            <td align="center">
                                <span class="btn btn-sm" wire:click="editarFuncionario({{ $element->id }})">
                                    <i class="fa fa-edit text-success"></i>
                                </span>

                                <span class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmFuncionario" wire:click="apagarFuncionario({{ $element->id }})">
                                    <i class="fa fa-trash text-danger"></i>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" align="center"><span class="text-danger">De momento não existem Funcionarioss cadastrados</span></td>
                        </tr>
                    @endforelse
                        

                    


                </table>

               {{ $funcionarios->links() }}

                
            </div>
        </div>
    </div>

{{-- Modal de confirmação --}}

        <div wire:ignore.self class="modal fade" id="deleteConfirmFuncionario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            $('#deleteConfirmFuncionariospan').modal('hide');
        })
     </script>
@endpush
