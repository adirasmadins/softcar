<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($vehicle,['id' => 'formVehicles']) ?>
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
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('plate',['label' => 'Placa','placeholder' => 'Placa','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('chassi',['label' => 'Chassi','placeholder' => 'Chassi','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('renavam',['label' => 'Renavam','placeholder' => 'Renavam','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('type_id',['label' => 'Tipo','placeholder' => 'Tipo','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('fuel_id',['label' => 'Combustível','placeholder' => 'Combustível','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->input('date_fabrication',['label' => 'Data de Fabricação','placeholder' => 'Data de Fabricação','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('mark',['label' => 'Marca','placeholder' => 'Marca','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('modelo',['label' => 'Modelo','placeholder' => 'Modelo','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->input('date_model',['label' => 'Data do Modelo','placeholder' => 'Data do Modelo','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('color',['label' => 'Cor','placeholder' => 'Cor','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->input('day_price',['label' => 'Valor Diária','placeholder' => 'Valor Diária','class' => 'form-control','type' => 'text']) ?>
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
    'formVehicles'
]));
?>