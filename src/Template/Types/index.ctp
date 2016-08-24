<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Tipos de veículo',
        'variavel' => 'types'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome'
    ],
    'name' => 'O tipo',
    'entity' => 'Tipos',
    'data' => $types
]]); ?>

<?= $this->element('paginate') ?>
