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
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('vehicle_id',['label' => 'Veículo','placeholder' =>'Veículo', 'class' => 'form-control','options' => $vehicles,'empty' => 'Selecione um veículo']); ?>
                </div>
                <div class="col-md-2 text-center" id="plate">
                    <label>Placa</label>
                    <h5><small>aguardando escolha do veículo...</small></h5>
                </div>
                <div class="col-md-2 text-center" id="model">
                    <label>Modelo</label>
                    <h5><small>aguardando escolha do veículo...</small></h5>
                </div>
                <div class="col-md-2 text-center" id="renavam">
                    <label>Renavam</label>
                    <h5><small>aguardando escolha do veículo...</small></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $this->Form->input('referent_year',['label' => 'Ano Referente','placeholder' => 'Ano Referente','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <section class="tabs tabs-style-iconfall">
                    <nav>
                        <ul>
                            <li><a href="#section-iconfall-1" class="icon icon-cog"><span>IPVA</span></a></li>
                            <li><a href="#section-iconfall-2" class="icon icon-cog"><span>DPVAT</span></a></li>
                            <li><a href="#section-iconfall-3" class="icon icon-cog"><span>Licenciamento</span></a></li>
                        </ul>
                    </nav>
                    <section class="content-wrap">
                        <section id="section-iconfall-1">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <?= $this->Form->input('ipva_value',['label' => 'Valor IPVA','placeholder' => 'Valor IPVA','class' => 'form-control','type' => 'text']) ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?= $this->Form->input('ipva_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $this->Form->input('ipva_status', ['label' => 'Status', 'class' => 'form-control', 'options' => ['0' => 'Não Pago', '1' => 'Pago']]) ?>
                                </div>
                            </div>
                        </section>
                        <section id="section-iconfall-2"">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <?= $this->Form->input('depvat_value',['label' => 'Valor DPVAT','placeholder' => 'Valor DPVAT','class' => 'form-control','type' => 'text']) ?>
                            </div>
                            <div class="col-md-4 form-group">
                                <?= $this->Form->input('depvat_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->input('depvat_status', ['label' => 'Status', 'class' => 'form-control', 'options' => ['0' => 'Não Pago', '1' => 'Pago']]) ?>
                            </div>
                        </div>
                    </section>
                    <section id="section-iconfall-3">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <?= $this->Form->input('licensing_value',['label' => 'Valor Licenciamento','placeholder' => 'Valor Licenciamento','class' => 'form-control','type' => 'text']) ?>
                            </div>
                            <div class="col-md-4 form-group">
                                <?= $this->Form->input('licensing_expiration',['label' => 'Vencimento','placeholder' => 'Vencimento','class' => 'form-control','type' => 'text']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->input('licensing_status', ['label' => 'Status', 'class' => 'form-control', 'options' => ['0' => 'Não Pago', '1' => 'Pago']]) ?>
                            </div>
                        </div>
                    </section>
                </section>
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
    </div>
</div>
<?= $this->Form->end() ?>
</div>
</div>

<?php
$this->append('css', $this->Html->css([
    'formRates',
    '../dist/tabs/tabs',
    '../dist/tabs/tabstyles'
]));
$this->append('script', $this->Html->script([
    '../dist/tabs/cbpFWTabs',
    '../dist/tabs/modernizr.custom',
    'form',
    '../dist/maskMoney/jquery.maskMoney',
    'formRates'
]));
?>