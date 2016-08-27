<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($rate,['id' => 'formRates','type' => 'file']) ?>
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
                <div class="col-md-6">
                    <?= $this->Form->input('vehicle_id',['label' => 'Veículo','placeholder' =>'Veículo', 'class' => 'form-control','options' => $vehicles,'empty' => 'Selecione um veículo']); ?>
                </div>
                <div class="col-md-2 text-center" id="plate">
                    <label>Placa</label>
                    <h4><small>aguardando escolha do veículo...</small></h4>
                </div>
                <div class="col-md-2 text-center" id="model">
                    <label>Modelo</label>
                    <h4><small>aguardando escolha do veículo...</small></h4>
                </div>
                <div class="col-md-2 text-center" id="renavam">
                    <label>Renavam</label>
                    <h4><small>aguardando escolha do veículo...</small></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $this->Form->input('referent_year',['label' => 'Ano Referente','placeholder' => 'Ano Referente','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#ipva" data-toggle="tab" aria-expanded="true">IPVA</a></li>
                            <li class=""><a href="#dpvat" data-toggle="tab" aria-expanded="false">DPVAT</a></li>
                            <li class=""><a href="#licenciamento" data-toggle="tab" aria-expanded="false">Licenciamento</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="ipva">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->Form->input('ipva_value',['label' => 'Valor IPVA','placeholder' => 'Valor IPVA','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('ipva_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="dpvat">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->Form->input('depvat_value',['label' => 'Valor DPVAT','placeholder' => 'Valor DPVAT','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('depvat_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="licenciamento">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $this->Form->input('licensing_value',['label' => 'Valor Licenciamento','placeholder' => 'Valor Licenciamento','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $this->Form->input('licensing_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
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
$this->append('css', $this->Html->css([
    'formRates'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/maskMoney/jquery.maskMoney',
    'formRates'
]));
?>