<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Motorista',
        'variavel' => 'drivers',
        'placeholder' => 'Digite o nome do motorista...',
        'search' => 'name'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome',
        'cpf' => 'CPF'
    ],
    'name' => 'O motorista',
    'entity' => 'Drivers',
    'data' => $drivers
]]); ?>

<?= $this->element('paginate') ?>
