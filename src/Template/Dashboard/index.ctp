<div class="col-md-12" style="margin-top: 20px;">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> Reservas Pendentes</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body" style="display: block;">
            <div class="col-md-12">
                <?php if(!empty($reservados)): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Veículo</th>
                                <th>Data e Hora da Retirada</th>
                                <th>Data e Hora da Devolução</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($reservados as $reserva): ?>
                                <tr>
                                    <td><?= \App\Lib\Utils::getClientOnlyName($reserva['client_id'])?></td>
                                    <td><?= \App\Lib\Utils::getVehicle($reserva['vehicle_id'])?></td>
                                    <td><?= $reserva['date_start']->i18nFormat('dd/MM/yyyy') . ' - ' . $reserva['remove_schedule']->i18nFormat('H:mm')?></td>
                                    <td><?= $reserva['date_end']->i18nFormat('dd/MM/yyyy') . ' - ' . $reserva['devolution_schedule']->i18nFormat('H:mm')?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <h5>Não há reservas pendentes</h5>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-footer clearfix" style="display: block;">
            <a href="<?=$this->Url->build('reserves/index', true) ?>" class="btn btn-sm btn-success pull-left"><i class="fa fa-globe" aria-hidden="true"></i> Todas as Reservas</a>
        </div>
    </div>
</div>