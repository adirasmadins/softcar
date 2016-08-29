<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($service,['id' => 'formServices']) ?>
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
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('vehicle_id',['label' => 'Veículo','placeholder' =>'Veículo', 'class' => 'form-control','options' => $vehicles,'empty' => 'Selecione um veículo']); ?>
                </div>
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('service_type',['label' => 'Tipo','class' => 'form-control', 'empty' => 'Selecione o Tipo de Serviço','options' => ['t' => 'Troca de Óleo','r' => 'Revisão', 'o' => 'Outro']]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 description form-group" style="display: none;">
                    <label>Descrição</label>
                    <input type="hidden" id="value-description" value="<?= $service->description ?>"/>
                    <textarea class="form-control" rows="3" placeholder="Descrição ..." id="description" name="description"></textarea>
                </div>
                <div class="col-md-4 make-km form-group">
                    <?= $this->Form->input('make_km',['label' => 'Quilometragem em que foi efetuado','placeholder' => 'Quilometragem','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('make_date',['label' => 'Data do Serviço', 'placeholder' => 'Data do Serviço','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('value',['label' => 'Valor Pago','placeholder' => 'Valor Pago','class' => 'form-control','type' => 'text']) ?>
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
    '../dist/maskMoney/jquery.maskMoney',
    'formServices'
]));
?>