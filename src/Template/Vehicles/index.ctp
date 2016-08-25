<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Veículo',
        'variavel' => 'vehicles'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'plate' => 'Placa',
        'model' => 'Modelo',
        'color' => 'Cor',
    ],
    'name' => 'O veículo',
    'entity' => 'Veículos',
    'data' => $vehicles
]]); ?>

<?= $this->element('paginate') ?>
