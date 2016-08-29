<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($vehicle,['id' => 'formVehicles','type' => 'file']) ?>
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
                    <?= $this->Form->input('renavam',['label' => 'Renavam','placeholder' => 'Renavam','class' => 'form-control','type' => 'text','maxlength' => 11]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-6 form-group" style="padding-left: 0px;">
                        <?= $this->Form->input('type_id',['label' => 'Tipo','placeholder' => 'Tipo','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6 form-group" style="padding-right: 0px;">
                        <?= $this->Form->input('fuel_id',['label' => 'Combustível','placeholder' => 'Combustível','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6 form-group" style="padding-left: 0px;">
                        <?= $this->Form->input('mark',['label' => 'Marca','placeholder' => 'Marca','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6 form-group" style="padding-right: 0px;">
                        <?= $this->Form->input('model',['label' => 'Modelo','placeholder' => 'Modelo','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6" style="padding-left: 0px;">
                        <?= $this->Form->input('date_model',['label' => 'Ano do Modelo','placeholder' => 'Data do Modelo','class' => 'form-control','type' => 'text']) ?>
                    </div>
                    <div class="col-md-6" style="padding-right: 0px;">
                        <?= $this->Form->input('date_fabrication',['label' => 'Ano de Fabricação','placeholder' => 'Data de Fabricação','class' => 'form-control','type' => 'text']) ?>
                    </div>
                    <div class="col-md-6 form-group" style="padding-left: 0px;">
                        <?= $this->Form->input('color',['label' => 'Cor Predominante','placeholder' => 'Cor','class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6" style="padding-right: 0px;">
                        <?= $this->Form->input('day_price',['label' => 'Valor Diária','placeholder' => 'Valor Diária','class' => 'form-control','type' => 'text']) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>Imagem do Veículo</label>
                    <a href="#" class="thumbnail">
                        <img id="target" class="img-responsive" style="height: 200px;" src="<?= $this->Url->build(isset($vehicle->picture) && !empty($vehicle->picture) ? $vehicle->picture : '/img/no_image.jpg') ?>" alt="Imagem">
                    </a>
                    <button class="btn btn-info" style="position: absolute;"><i class="fa fa-cloud-upload"></i>&nbsp;Selecionar Imagem</button>
                    <?= $this->Form->hidden('current_picture', ['id' => 'current-picture', 'value' => isset($vehicle->picture) && !empty($vehicle->picture) ? $vehicle->picture : '']) ?>
                    <span class="btn fileinput-button white-field margin-bottom" style="margin-left: -25px !important; margin-top: -15px !important; opacity: 0">
                    <span id="upload_filename">Selecione um arquivo...</span><span id="findlabel">Procurar</span>
                    <input type="file" name="picture" multiple="" id="picture">
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

<?php
$this->append('css', $this->Html->css([
    'formVehicles'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/maskMoney/jquery.maskMoney',
    'formVehicles'
]));
?>