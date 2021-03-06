<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($location,['id' => 'formLocations']) ?>
        <div class="box-header hidden-sm hidden-xs">
            <h4 class="panel-head"><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="panel-body">
            <input type="hidden" id="id-location" value="<?= $location->id ?>">
            <div class="row">
                <div class="col-md-3 form-group">
                    <input type="hidden" class="out-date" value="<?= $location->out_date ?>"/>
                    <?= $this->Form->input('out_date',['label' => 'Data de Retirada','placeholder' => 'Data de Retirada','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-3 form-group">
                  <input type="hidden" class="return-date" value="<?= $location->return_date ?>"/>
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
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="hidden" name="client_id_hidden" id="client_id_hidden">
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
            <div class="row">
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('driver_id',['label' => 'Motorista', 'class' => 'form-control','options' => $drivers,'empty' => 'Sem motorista']); ?>
                </div>
                <div class="col-md-6 form-group">
                    <input type="hidden" value="<?= $location->tank_check ?>" id="tank_check_">
                    <textarea placeholder="Verificação de Tanque" name="tank_check" id="tank_check"></textarea>
                </div>
            </div>
            <div class="row vehicles">
                <div class="col-md-6 form-group">
                    <input type="hidden" name="vehicle_id_hidden" id="vehicle-id-hidden" value="">
                    <div class="vehicle-input">
                        <?= $this->Form->input('vehicle_id',['label' => 'Veículo', 'class' => 'form-control']); ?>
                    </div>
                    <div class="div-total">
                        <h2 class="pull-left">TOTAL R$</h2>
                        <input type="hidden" id="start_value" name="start_value" value="">
                        <?= $this->Form->input('total',['label' => false, 'type' => 'text']); ?>
                    </div>
                    <div class="acrescimo-desconto text-center" style="display: none">
                        <h5>Acréscimo / Desconto</h5>
                        <input type="text" id="valor">
                        <button class="btn btn-success btn-calcular btn-xs btn-flat"><i class="fa fa-check-circle"></i> Calcular</button>
                    </div>
                    <input type="hidden" class="km_inicial" name="start_km" value="">
                    <input type="hidden" class="km_final" name="km_final" value="">
                    <?php if(!$location->id): ?>
                      <h5 class="km-inicial">KM Inicial: <span><?= $location->km_inicial ? $location->km_inicial : '' ?></span></h5>
                      <h5 class="km-final">KM Final: <span><?= $location->free_km == 1 ? ' ILIMITADO' : '' ?></span></h5>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-9" style="margin-top: 10px">
                            <div class="input-group">
                                <input type="text" name="allowed_km" value="<?= $location->allowed_km ?>" id="allowed_km" class="form-control" placeholder="Quilometragem permitida">
                                <div class="input-group-addon">
                                    km
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label style="margin-top: 17px;">
                              <?php if($location->id): ?>
                                <?php if($location->free_km == 1): ?>
                                  <input type="checkbox" value="1" id="free_km" name="free_km" class="form-control" checked>
                                <?php else: ?>
                                  <input type="checkbox" value="1" id="free_km" name="free_km" class="form-control">
                                <?php endif; ?>
                              <?php else: ?>
                                <input type="checkbox" value="1" id="free_km" name="free_km" class="form-control">
                              <?php endif; ?>
                                Livre?
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top: 10px">
                            <?= $this->Form->input('form_payment',['label' => 'Forma de Pagamento', 'class' => 'form-control','options' => ['dinheiro' => 'Dinheiro', 'cartao' => 'Cartão', 'cheque' => 'Cheque']]); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="img">
                    <figure>
                        <a href="#" class="btn btn-visualizacao btn-info btn-xs" style="display: <?= $location->id ? 'block' : 'none' ?>"><i class="fa fa-info-circle"></i> info</a>
                        <img src="<?= $location->id ? $location->vehicle_picture : '' ?>" class="thumbnail img-responsive"/>
                        <span class="sub-img" style="display: <?= $location->id ? 'block' : 'none' ?>;"><?= isset($location->day_price_vehicle) ? '<h3>R$ ' . $location->day_price_vehicle . '<small>(diária)</small></h3>': '' ?></span>
                    </figure>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <?php if(!$location->id): ?>
              <?= $this->element('Form/button',['options' =>[
                  'text' => 'Salvar',
                  'action' => 'add',
                  'class' => 'btn btn-success',
                  'type' => 'submit',
                  'icon' => 'check'
              ]]) ?>
            <?php endif; ?>
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

    <!-- Modal de Reservas -->
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

    <?php $infos = \App\Lib\Utils::getAllInformationsVehicles($location->vehicle_id, 'tudo') ?>

    <!-- Modal Imagem -->
    <div class="modal fade bs-example-modal-lg" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="car-name-modal">
                      Informações do Veículo
                    </h4>
                    <a class="btn btn-info pull-right fechar-top" data-dismiss="modal">Fechar</a>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Modelo</th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Diária</th>
                                <th>Combustível</th>
                                <th>Cor</th>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?= $infos['model'] ?></td>
                                <td><?= $infos['plate'] ?></td>
                                <td><?= $infos['mark'] ?></td>
                                <td><?= \App\Lib\Utils::getDependInformationVehicle('Types', $infos['type_id']) ?></td>
                                <td>R$ <?= $infos['day_price'] ?></td>
                                <td><?= \App\Lib\Utils::getDependInformationVehicle('Fuels', $infos['fuel_id']) ?></td>
                                <td><?= $infos['color'] ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <img src="<?= $this->request->webroot . \App\Lib\Utils::getAllInformationsVehicles($location->vehicle_id, 'picture') ?>" class="image-responsive thumbnail" style="width: 100%" id="imagem-modal">
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->append('css', $this->Html->css([
    '../dist/lightbox/src/css/lightbox',
    '../dist/timepicker/bootstrap-timepicker.min',
    '../dist/iCheck/square/blue',
    'formLocations'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/lightbox/src/js/lightbox',
    '../dist/moment/moment.js',
    '../dist/maskMoney/jquery.maskMoney',
    '../dist/timepicker/bootstrap-timepicker.min',
    '../dist/iCheck/icheck',
    'formLocations'
]));
?>
