<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Usuário',
        'variavel' => 'users'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome',
        'phone' => 'Telefone',
        'status' => 'Status'
    ],
    'name' => 'O usuário',
    'entity' => 'Users',
    'data' => $users
]]); ?>

<?= $this->element('paginate') ?>
