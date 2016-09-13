<?=
$this->element('Form/header_index',[
    'options' => [
        'name' => 'Multa',
        'variavel' => 'tickets',
        'placeholder' => 'Digite a placa do veículo...',
        'search' => 'plate'
    ]
])
?>


<?= $this->element('table',['options' => [
    'column' => [
        'id' => '#ID',
        'vehicle_id' => 'Veículo',
        'value' => 'Valor',
        'ticket_date' => 'Data da Multa',
        'due_date' => 'Data de Vencimento',
        'status' => 'Pago?',
    ],
    'name' => 'A Multa',
    'entity' => 'Tickets',
    'data' => $tickets
]]); ?>

    <div class="tooltip-ticket">
        <p>Clique aqui para marcar essa multa como paga!</p>
    </div>

<?= $this->element('paginate') ?>

<?php
$this->append('script', $this->Html->script([
    'form',
    'indexTickets'
]));
?>