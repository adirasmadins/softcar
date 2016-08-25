<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Combustível',
        'variavel' => 'fuels',
        'placeholder' => 'Digite o nome do combustível...'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome'
    ],
    'name' => 'O combustível',
    'entity' => 'Fuels',
    'data' => $fuels
]]); ?>

<?= $this->element('paginate') ?>
