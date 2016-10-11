<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($reserve,['id' => 'formReserves']) ?>
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
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('date_start',['label' => 'Data de Retirada','placeholder' => 'Data de Retirada','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('date_end',['label' => 'Data de Devolução','placeholder' => 'Data de Devolução','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <label>Horário de Saída</label>
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="remove_schedule" value="<?= $reserve->remove_schedule ?>" id="remove_schedule" class="form-control timepicker">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-group hour">
                    <label>Horário de Devolução</label>
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="devolution_schedule" value="<?= $reserve->devolution_schedule ?>" id="devolution_schedule" class="form-control timepicker">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 disp">
                    <button type="button" class="btn btn-primary" id="disp"><i class="fa fa-search"></i> Verificar disponibilidade</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row clients" style="display: <?= $reserve->id ? 'block' : 'none' ?>">
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('client_id',['label' => 'Cliente', 'class' => 'form-control','options' => $clients,'empty' => 'Selecione um cliente']); ?>
                </div>
                <div class="col-md-2 col-xs-4 text-center dados-client" id="cnh">
                    <label>CNH</label>
                    <h5>aguardando escolha do cliente...</h5>
                </div>
                <div class="col-md-2 col-xs-4 text-center dados-client" id="cpf">
                    <label>CPF</label>
                    <h5>aguardando escolha do cliente...</h5>
                </div>
                <div class="col-md-2 col-xs-4 text-center dados-client" id="city">
                    <label>Cidade</label>
                    <h5>aguardando escolha do cliente...</h5>
                </div>
            </div>
            <div class="row vehicles" style="display: <?= $reserve->id ? 'block' : 'none' ?>">
                <input type="hidden" value="<?= $reserve->vehicle_id ?>" id="vehicle-id-hidden" name="vehicle-id-hidden">
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('vehicle_id',['label' => 'Veículo', 'class' => 'form-control','empty' => 'Selecione um veículo']); ?>
                    <div class="div-total">
                        <h2 class="pull-left">TOTAL</h2>
                        <h2 class="pull-right total"><?= $reserve->id ? 'R$ ' . number_format((float)$reserve->total,2, ',','.') : 'R$ 0,00' ?></h2>
                        <input id="total" name="total" type="hidden">
                        <!--<button class="btn btn-default btn-flat acres-desc"><i class="fa fa-edit"></i></button>-->
                    </div>
                    <div class="acrescimo-desconto text-center" style="display: none">
                        <h5>Acréscimo / Desconto</h5>
                        <input type="text" id="valor">
                        <button class="btn btn-success btn-calcular btn-xs btn-flat"><i class="fa fa-check-circle"></i> Calcular</button>
                    </div>
                </div>
                <div class="col-md-6" id="img" style="display: <?= $reserve->id ? 'block' : 'none' ?>">
                    <figure>
                        <img src="<?= $reserve->id ? $reserve->vehicle_picture : '' ?>" class="thumbnail img-responsive"/>
                        <span class="sub-img"><?= isset($reserve->day_price_vehicle) ? '<h3>R$ ' . $reserve->day_price_vehicle . '<small>(diária)</small></h3>': '' ?></span>
                    </figure>
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
    '../dist/timepicker/bootstrap-timepicker.min',
    'formReserves'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/moment/moment.js',
    '../dist/timepicker/bootstrap-timepicker.min',
    '../dist/moment/moment.js',
    'formReserves'
]));
?>