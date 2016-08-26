<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Veículo',
        'variavel' => 'vehicles',
        'placeholder' => 'Digite a placa do veículo...',
        'search' => 'plate'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'plate' => 'Placa',
        'model' => 'Modelo',
        'color' => 'Cor',
        'day_price' => 'Diária'
    ],
    'name' => 'O veículo',
    'entity' => 'Vehicles',
    'data' => $vehicles
]]); ?>


    <div class="view-vehicle">
        <h4 class="text-center">buscando foto...</h4>
        <img src="" class="thumbnail img-responsive"/>
    </div>

<?= $this->element('paginate') ?>

<?php
$this->append('css', $this->Html->css([
    'indexVehicles'
]));

$this->append('script', $this->Html->script([
    'form',
    'indexVehicles'
]));
?>