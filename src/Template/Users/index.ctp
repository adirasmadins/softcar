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
