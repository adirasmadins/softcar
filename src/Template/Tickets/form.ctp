<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($ticket,['id' => 'formTickets']) ?>
        <div class="box-header hidden-sm hidden-xs">
            <h4 class="panel-head"><span><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="box-header hidden-md hidden-lg text-center">
            <h4><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('vehicle_id',['label' => 'Veículo', 'class' => 'form-control','options' => $vehicles,'empty' => 'Selecione um veículo']); ?>
                </div>
                <div class="col-md-2 col-xs-4 text-center" id="plate">
                    <label>Placa</label>
                    <h5>aguardando escolha do veículo...</h5>
                </div>
                <div class="col-md-2 col-xs-4 text-center" id="model">
                    <label>Modelo</label>
                    <h5>aguardando escolha do veículo...</h5>
                </div>
                <div class="col-md-2 col-xs-4 text-center" id="renavam">
                    <label>Renavam</label>
                    <h5>aguardando escolha do veículo...</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <?= $this->Form->input('client_id',['label' => 'Cliente (Infrator)','empty' => 'Selecione o Cliente','class' => 'form-control','options' => $clients]) ?>
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
                <div class="col-md-6">
                    <label class="infrator">
                        <input type="checkbox" id="not-registered" class="form-control" <?= !empty($ticket->name_not_registered) ? 'checked' : ''?>>
                        Infrator não cadastrado
                        &nbsp;
                    </label>
                    <div id="not-registered-modal" class="modal fade" role="dialog" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Dados Infrator</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?= $this->Form->input('name_not_registered',['label' => 'Nome','placeholder' => 'Nome','class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?= $this->Form->input('cpf_not_registered',['label' => 'CPF','placeholder' => 'CPF','class' => 'form-control','type' => 'text']) ?>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <?= $this->Form->input('rg_not_registered',['label' => 'RG','placeholder' => 'RG','class' => 'form-control','type' => 'text']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success save-modal" data-dismiss="modal"><i class="fa fa-check"></i> Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" style="display: none" class="btn btn-info btn-xs view-not-registered"><i class="fa fa-eye"></i> ver informações...</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 description form-group">
                    <label>Descrição</label>
                    <input type="hidden" id="value-description" value="<?= $ticket->description ?>"/>
                    <textarea class="form-control" rows="3" placeholder="Descrição ..." id="description" name="description"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('value',['label' => 'Valor Multa','placeholder' => 'Valor Multa','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('ticket_date',['label' => 'Data da Multa','placeholder' => 'Data da Multa','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('due_date',['label' => 'Data de Vencimento','placeholder' => 'Data de Vencimento','class' => 'form-control','type' => 'text']) ?>
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
    '../dist/iCheck/flat/blue',
    'formTickets'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/maskMoney/jquery.maskMoney',
    '../dist/iCheck/icheck',
    'formTickets'
]));
?>