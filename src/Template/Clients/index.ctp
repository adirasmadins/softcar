<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Cliente',
        'variavel' => 'clients'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome',
        'cpf_cnpj' => 'CPF/CNPJ',
        'cnh' => 'CNH',
        'cel_phone' => 'Celular'
    ],
    'name' => 'O cliente',
    'entity' => 'Clients',
    'data' => $clients
]]); ?>

<?= $this->element('paginate') ?>