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
        'ipva_expiration' => 'Venc. IPVA',
        'depvat_expiration' => 'Venc. DPVAT',
        'licensing_expiration' => 'Venc. Licenciamento'
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