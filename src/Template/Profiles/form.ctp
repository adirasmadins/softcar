<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($user,['id' => 'formProfiles']) ?>
        <div class="box-header hidden-sm hidden-xs">
            <h4 class="panel-head"><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="box-header hidden-md hidden-lg text-center">
            <h4><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 form-group">
                    <?= $this->Form->input('name',['label' => 'Nome','placeholder' => 'Nome','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('gender',['label' => 'Sexo','placeholder' => 'Status','class' => 'form-control','options' => ['m' => 'Masculino','f' => 'Feminino']]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                     <?= $this->Form->input('menus._ids',['label' => 'Permissões','options' => $menus],['style' => 'width:100%']) ?>
                </div>
            </div>
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
$this->append('script', $this->Html->script([
    'form',
    'formProfiles'
]));
?>