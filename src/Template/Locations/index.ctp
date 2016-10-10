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
        'return_date' => 'Data de Devolução'
    ],
    'name' => 'A Locação',
    'entity' => 'Locations',
    'data' => $locations
]]); ?>

    <div class="tooltip-contract">
        <p>Clique aqui para gerar o contrato da locação</p>
    </div>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexLocations'
]));
?>