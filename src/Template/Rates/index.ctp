<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Tarífa',
        'variavel' => 'rates',
        'placeholder' => 'Digite a placa do veículo...',
        'search' => 'plate'
    ]
])
?>


<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'vehicle_id' => 'Veículo',
        'referent_year' => 'Ano Referente',
        'ipva_value' => 'Valor IPVA',
        'depvat_value' => 'Valor DPVAT',
        'licensing_value' => 'Valor Licenciamento'
    ],
    'name' => 'A Tarifa',
    'entity' => 'Rates',
    'data' => $rates
]]); ?>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexRates'
]));
?>