<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($location,['id' => 'formLocations']) ?>
        <div class="box-header hidden-sm hidden-xs">
            <h4 class="panel-head"><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="box-header hidden-md hidden-lg text-center">
            <h4><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="panel-body">

        </div>
        <div class="panel-footer">
            <?= $this->element('Form/button',['options' =>[
                'text' => 'Salvar',
                'action' => 'add',
                'class' => 'btn btn-success',
                'type' => 'submit',
                'icon' => 'check'
            ]]) ?>
            <?= $this->Html->Link('<i class="fa fa-undo"></i> Voltar',
                [
                    'action' => 'index'
                ],
                [
                    'class' => 'btn btn-warning',
                    'escape' => false
                ])
            ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
$this->append('css', $this->Html->css([
    '../dist/timepicker/bootstrap-timepicker.min'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/moment/moment.js',
    '../dist/timepicker/bootstrap-timepicker.min',
    'formLocations'
]));
?>