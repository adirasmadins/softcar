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
        'client_id' => 'Cliente'
    ],
    'name' => 'A Locação',
    'entity' => 'Locations',
    'data' => $locations
]]); ?>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexLocations'
]));
?>