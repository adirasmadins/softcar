<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Reserva',
        'variavel' => 'reserves',
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
        'date_start' => 'Data Inicial',
        'date_end' => 'Data Final'
    ],
    'name' => 'A Reserva',
    'entity' => 'Reserves',
    'data' => $reserves
]]); ?>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexReserves'
]));
?>