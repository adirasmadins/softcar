<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Cidade',
        'variavel' => 'cities',
        'placeholder' => 'Digite o nome da cidade...',
        'search' => 'name'
    ]
])
?>

<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'name' => 'Cidade',
        'state_id' => 'Estado'
    ],
    'name' => 'A cidade',
    'entity' => 'Cities',
    'data' => $cities
]]); ?>

<?= $this->element('paginate') ?>
