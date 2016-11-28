<div class="row">
    <div class="col-md-12" style="margin-top: 20px;">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Locações em andamento</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body" style="display: block;">
                <div class="col-md-12">
                    <?php if(!empty($locados)): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Veículo</th>
                                    <th>Data Saída</th>
                                    <th>Data Chegada</th>
                                    <th>Quilometragem Livre?</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($locados as $locacao): ?>
                                    <tr>
                                        <td><?= \App\Lib\Utils::getClientOnlyName($locacao['client_id'])?></td>
                                        <td><?= \App\Lib\Utils::getVehicle($locacao['vehicle_id'])?></td>
                                        <td><?= $locacao['out_date']->i18nFormat('dd/MM/yyyy') ?></td>
                                        <td><?= $locacao['return_date']->i18nFormat('dd/MM/yyyy') ?></td>
                                        <td><?= $locacao['free_km'] == 0 ? $locacao['allowed_km'] . 'km permitidos' : 'Sim'?></td>
                                        <td>R$ <?= number_format((float)$locacao['total'], 2, ',', '.')?></td>
                                        <td>
                                            <button
                                                type="button"
                                                data-id="<?= $locacao['id'] ?>"
                                                data-clientid="<?= \App\Lib\Utils::getClientOnlyName($locacao['client_id']) ?>"
                                                data-vehicleid="<?= \App\Lib\Utils::getVehicle($locacao['vehicle_id']) ?>"
                                                data-vehicleidenti="<?= $locacao['vehicle_id'] ?>"
                                                data-driver="<?= $locacao['driver_id'] ?>"
                                                data-total="<?= number_format((float)$locacao['total'], 2, ',', '.') ?>"
                                                data-allowedkm="<?= $locacao['allowed_km'] ?>"
                                                data-freekm="<?= $locacao['free_km'] ?>"
                                                data-startkm="<?= $locacao['start_km'] ?>"
                                                data-tankcheck="<?= $locacao['tank_check'] ?>"
                                                data-returndate="<?= $locacao['return_date']->i18nFormat('dd/MM/yyyy') ?>"
                                                class="btn btn-warning baixar btn-sm pull-right"
                                            >
                                                <i class="fa fa-check"></i>
                                                Confirmar recebimento locação
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <h5>Não há locações em andamento</h5>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-footer clearfix" style="display: block;">
                <a href="<?=$this->Url->build('/locations/index', true) ?>" class="btn btn-sm btn-info pull-left"><i class="fa fa-globe" aria-hidden="true"></i> Todas as Locações</a>
                <a href="<?=$this->Url->build('/locations/add', true) ?>" style="margin-left: 10px;" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Locação</a>
            </div>
        </div>
    </div>
</div>
