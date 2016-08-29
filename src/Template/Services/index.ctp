<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Serviço/Manutenção',
        'variavel' => 'services',
        'placeholder' => 'Digite a placa do veículo...',
        'search' => 'plate'
    ]
])
?>


<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'vehicle_id' => 'Veículo',
        'service_type' => 'Serviço',
        'value' => 'Valor'
    ],
    'name' => 'O Serviço',
    'entity' => 'Services',
    'data' => $services
]]); ?>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexRates'
]));
?>