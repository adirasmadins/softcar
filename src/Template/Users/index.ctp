<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Usuário',
        'variavel' => 'users',
        'placeholder' => 'Digite o nome do usuário...',
        'search' => 'name'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome',
        'login' => 'Login',
        'cpf' => 'CPF',
        'status' => 'Status'
    ],
    'name' => 'O usuário',
    'entity' => 'Users',
    'data' => $users
]]); ?>

<?= $this->element('paginate') ?>
