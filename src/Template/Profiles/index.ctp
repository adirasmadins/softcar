<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Perfil',
        'variavel' => 'profiles'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Nome'
    ],
    'name' => 'O perfil',
    'entity' => 'Profiles',
    'data' => $profiles
]]); ?>

<?= $this->element('paginate') ?>
