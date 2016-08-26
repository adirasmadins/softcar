<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Veículo',
        'variavel' => 'vehicles',
        'placeholder' => 'Digite a placa do veículo...'
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

<?= $this->element('paginate') ?>
