<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <?php $controller = $this->request->controller; ?>
                <?php foreach($options['column'] as $key => $coluna): ?>
                    <th><?= $coluna ?></th>
                <?php endforeach; ?>
                <th class="text-center" style="width: <?= $controller == 'Vehicles' || $controller == 'Tickets' || $controller == 'Locations' ? '180px' : '100px' ?>">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($options['data'] as $item): ?>
                <tr>
                    <?php foreach($options['column'] as $key => $info): ?>
                        <?php if(($key == 'status') && (($this->request->controller != 'Tickets') && ($this->request->controller != 'Reserves') && ($this->request->controller != 'Locations'))): ?>
                            <?php $item->$key = \App\Lib\Utils::getStatusReal($item->$key) ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'status') && ($this->request->controller == 'Tickets')): ?>
                            <?php $item->$key = \App\Lib\Utils::getStatusTicket($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'status') && ($this->request->controller == 'Reserves')): ?>
                            <?php $item->$key = \App\Lib\Utils::getStatusReserves($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'status') && ($this->request->controller == 'Locations')): ?>
                            <?php $item->$key = \App\Lib\Utils::getStatusLocations($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'created') || ($key == 'ipva_expiration') || ($key == 'depvat_expiration') || ($key == 'licensing_expiration') || ($key == 'due_date') || ($key == 'ticket_date') || ($key == 'date_start') || ($key == 'date_end') || ($key == 'out_date') || ($key == 'return_date')): ?>
                            <?php $item->$key = $item->$key->i18nFormat('dd/MM/yyyy'); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'day_price') || $key == 'value' || $key == 'total'): ?>
                            <td><?='R$ ' . $item->$key ?> </td>
                        <?php elseif($key == 'client_id'): ?>
                            <?php $item->$key = \App\Lib\Utils::getClientName($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif($key == 'state_id'): ?>
                            <?php $item->$key = \App\Lib\Utils::getStateName($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif($key == 'vehicle_id'): ?>
                            <?php $item->$key = \App\Lib\Utils::getVehicle($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif($key == 'service_type'): ?>
                            <?php $item->$key = \App\Lib\Utils::getServiceReal($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php else: ?>
                            <td><?= $item->$key ?></td>
                        <?php endif ?>
                    <?php endforeach; ?>
                    <td class="text-center">
                        <div class="btn-group hidden-xs">
                            <?php if($this->request->controller == 'Vehicles'): ?>
                                <a href="#" data-url="<?= $item->picture ?>" data-model="<?= $item->model ?>" class="btn btn-info btn-flat btn-flash"><i class="fa fa-bolt"></i></a>
                            <?php endif; ?>
                            <?php if($this->request->controller == 'Tickets'): ?>
                                <button type="button" data-id="<?= $item->id ?>" class="btn btn-success btn-pay btn-flat" <?= strpos($item->status, 'Sim') ? 'disabled' : '' ?>><i class="fa fa-check"></i></button>
                            <?php endif; ?>
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'),['action' => 'edit', $item->id],['escape' => false,'class' => 'btn btn-warning btn-flat']) ?>
                                <a href="#" data-id="<?= $item->id ?>" id="btn-deletar" class="btn btn-danger btn-flat btn-deletar"><i class="fa fa-trash"></i></a>
                            <?php if($this->request->controller == 'Locations'): ?>
                                <a href="#" data-id="<?= $item->id ?>" class="btn btn-success btn-flat btn-contrato"><i class="fa fa-file-pdf-o"></i></a>
                                <button data-id="<?= $item->id ?>" class="btn btn-info btn-flat btn-info-location info-<?= $item->id ?>" <?= strpos($item->status, 'Não') ? 'disabled' : '' ?>><i class="fa fa-info-circle"></i></button>
                            <?php endif; ?>
                        </div>
                        <div class="btn-group-vertical hidden-md hidden-lg hidden-sm">
                            <?php if($this->request->controller == 'Tickets'): ?>
                                <button type="button" data-id="<?= $item->id ?>" class="btn btn-default btn-pay fa-xs btn-flat" <?= strpos($item->status, 'Sim') ? 'disabled' : '' ?>><i class="fa fa-check"></i></button>
                            <?php endif; ?>
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'),['action' => 'edit', $item->id],['escape' => false,'class' => 'btn btn-default btn-flat fa-xs']) ?>
                            <?php if($this->request->controller != 'Locations'): ?>
                              <a href="#" data-id="<?= $item->id ?>" id="btn-deletar" class="btn btn-danger btn-flat btn-deletar"><i class="fa fa-trash"></i></a>
                            <?php else: ?>
                            <a href="#" data-id="<?= $item->id ?>" class="btn btn-success btn-flat btn-contrato"><i class="fa fa-file-pdf-o"></i></a>
                            <button data-id="<?= $item->id ?>" class="btn btn-info btn-flat btn-info-location" <?= strpos($item->status, 'Não') ? 'disabled' : '' ?>><i class="fa fa-info-circle"></i></button>
                          <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var entity = '<?= $options['entity'] ?>';
    var type = '<?= $options['name'] ?> ';
</script>

<?php
$this->append('script', $this->Html->script([
    'elementTable'
]));
?>
