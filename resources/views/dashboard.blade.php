<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card card-showder">
        <div class="card-header bg-primary"></div>
        <div class="card-body">

            <div class="row text-center">

                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <label class="text-secondary font-weight-bold"><strong>Realização de venda</strong></label>
                        <h1 class="text-success">
                            <a href="#" class="text-success">
                                <i class="fa-solid fa-cart-plus"></i>
                            </a>
                        </h1>             
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                       <label class="text-secondary font-weight-bold"><strong>Informações de estatística</strong></label>
                       <h1 class="text-success">
                          <a href="#" class="text-success">
                              <i class="fa fa-chart-column"></i>
                          </a>
                           
                       </h1>              
                </div>


                <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
                       <label class="text-secondary font-weight-bold"><strong>Relatórios</strong></label>

                       <h1 class="text-success">
                        <a href="#" class="text-success">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        </a>
                           
                       </h1>              
                </div>


            </div>
        </div>
    </div>

</x-app-layout>