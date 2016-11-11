<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($contract,['id' => 'formContract']) ?>
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
                <div class="col-md-12">
                     <?= $this->Form->input('texto',['label' => false,'id' => 'summernote']) ?>
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
                <button id="visualizar" class="btn btn-info"><i class="fa fa-eye"></i> Visualizar</button>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php
$this->append('css', $this->Html->css([
    '../dist/summernote/summernote',
    'formContract'
]));
$this->append('script', $this->Html->script([
    '../dist/summernote/summernote.min',
    'formContract'
]));
?>
