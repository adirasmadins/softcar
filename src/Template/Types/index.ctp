<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Tipos de veículo',
        'variavel' => 'types',
        'placeholder' => 'Digite a descrição do tipo...',
        'search' => 'name'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Descrição'
    ],
    'name' => 'O tipo',
    'entity' => 'Tipos',
    'data' => $types
]]); ?>

<?= $this->element('paginate') ?>
