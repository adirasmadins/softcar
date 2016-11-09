<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Locação',
        'variavel' => 'locations',
        'placeholder' => 'Digite a placa do veículo...',
        'search' => 'plate'
    ]
])
?>


<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'vehicle_id' => 'Veículo',
        'client_id' => 'Cliente',
        'out_date' => 'Data de Saída',
        'return_date' => 'Data de Devolução',
        'status' => 'Finalizada?'
    ],
    'name' => 'A Locação',
    'entity' => 'Locations',
    'data' => $locations
]]); ?>

    <div class="tooltip-contract">
        <p>Clique aqui para gerar o contrato da locação</p>
    </div>

    <div class="tooltip-info-msg">
        <p>Clique aqui para ver informações referente a saída e chegada da locação</p>
    </div>

    <div class="tooltip-info text-center">
        <div class="table-responsive iniciou">
          <table class="table table-bordered">
            <thead>
              <h5 class="text-center">Iniciou com</h5>
              <tr>
                <th>Km</th>
                <th>Valor</th>
                <th>Tanque</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-responsive entregou">
          <table class="table table-bordered">
            <h5 class="text-center">Entregou com</h5>
            <thead>
              <tr>
                <th>Km</th>
                <th>Valor</th>
                <th>Tanque</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <h5 class="infos"></h5>
        <h5 class="calc-in"><i class="fa fa-cog fa-spin"></i> Calculando informações</h5>
    </div>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexLocations'
]));
?>
