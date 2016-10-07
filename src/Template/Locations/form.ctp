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
            <div class="row">
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('out_date',['label' => 'Data de Retirada','placeholder' => 'Data de Retirada','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('return_date',['label' => 'Data de Devolução','placeholder' => 'Data de Devolução','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <label>Horário de Saída</label>
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="remove_schedule" value="" id="remove_schedule" class="form-control timepicker">
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
                            <input type="text" name="devolution_schedule" value="" id="devolution_schedule" class="form-control timepicker">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row"">
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

<div class="modal fade" id="reserves" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="myModalLabel">Deseja carregar alguma reserva pré cadastrada?</h4>
            </div>
            <div class="modal-body">
                <?php if($reserves): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Cliente</th>
                                <th>Veículo</th>
                                <th>Data de Saída</th>
                                <th>Data de Devolução</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($reserves as $reserve): ?>
                                <tr>
                                    <td><input type="radio" name="reserve" value="<?= $reserve['id'] ?>" class="form-control"></td>
                                    <td><?= \App\Lib\Utils::getClientOnlyName($reserve['client_id']) ?></td>
                                    <td><?= \App\Lib\Utils::getVehicle($reserve['vehicle_id']) ?></td>
                                    <td><?= $reserve['date_start']->i18nFormat('dd/MM/yyyy') ?></td>
                                    <td><?= $reserve['date_end']->i18nFormat('dd/MM/yyyy') ?></td>
                                    <td>R$ <?= $reserve['total'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <h5>Não há reservas pré cadastradas</h5>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <span class="pull-left" style="display: none">buscando informações da reserva ...</span>
                <button type="button" class="btn btn-success" id="carregar"><i class="fa fa-check-circle"></i> Carregar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->append('css', $this->Html->css([
    '../dist/timepicker/bootstrap-timepicker.min',
    '../dist/iCheck/square/blue'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/moment/moment.js',
    '../dist/timepicker/bootstrap-timepicker.min',
    '../dist/iCheck/icheck',
    'formLocations'
]));
?>