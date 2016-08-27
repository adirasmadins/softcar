<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <?php foreach($options['column'] as $key => $coluna): ?>
                    <th><?= $coluna ?></th>
                <?php endforeach; ?>
                <th class="text-center" style="width: <?= $this->request->controller == 'Vehicles' ? '130px' : '100px' ?>">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($options['data'] as $item): ?>
                <tr>
                    <?php foreach($options['column'] as $key => $info): ?>
                        <?php if($key == 'status'): ?>
                            <?php $item->$key = \App\Lib\Utils::getStatusReal($item->$key) ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif(($key == 'created') || ($key == 'ipva_expiration') || ($key == 'depvat_expiration') || ($key == 'licensing_expiration')): ?>
                            <?php $item->$key = $item->$key->i18nFormat('dd/MM/yyyy'); ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif($key == 'day_price'): ?>
                            <?php $item->$key = 'R$' . $item->$key ?>
                            <td><?= $item->$key ?></td>
                        <?php elseif($key == 'vehicle_id'): ?>
                            <?php $item->$key = \App\Lib\Utils::getVehicle($item->$key); ?>
                            <td><?= $item->$key ?></td>
                        <?php else: ?>
                            <td><?= $item->$key ?></td>
                        <?php endif ?>
                    <?php endforeach; ?>
                    <td>
                        <div class="btn-group hidden-xs">
                            <?php if($this->request->controller == 'Vehicles'): ?>
                                <a href="#" data-url="<?= $item->picture ?>" data-model="<?= $item->model ?>" class="btn btn-info btn-flat btn-flash"><i class="fa fa-bolt"></i></a>
                            <?php endif; ?>
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'),['action' => 'edit', $item->id],['escape' => false,'class' => 'btn btn-warning btn-flat']) ?>
                            <a href="#" data-id="<?= $item->id ?>" id="btn-deletar" class="btn btn-danger btn-flat btn-deletar"><i class="fa fa-trash"></i></a>
                        </div>
                        <div class="btn-group-vertical hidden-md hidden-lg hidden-sm">
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i>'),['action' => 'edit', $item->id],['escape' => false,'class' => 'btn btn-default btn-flat']) ?>
                            <a href="#" data-id="<?= $item->id ?>" id="btn-deletar" class="btn btn-default btn-flat btn-deletar"><i class="fa fa-trash"></i></a>
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

    $(document).on('click','#btn-deletar', function(){
        var id = $(this).data('id');
        swal({
            title: "Deseja realmente apagar este registro?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim, quero apagar',
            confirmButtonClass: "btn-danger",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            var url = webroot + entity + '/delete';
            var data = {id: id};
            $.post(url, data, function(e){
                if(e.result.type === 'success'){
                    swal({
                        title: type + e.result.data + ' foi apagado(a) com sucesso!',
                        showCancelButton: false,
                        type: 'success',
                        showConfirmButton: false
                    });
                    location.reload();
                } else if(e.result.type === 'error'){
                    swal('Houve algum problema ao apagar este registro', '', 'danger');
                } else {
                    swal({
                        title: 'Ops!',
                        text: 'Esse registro possui vínculo, não é possível excluir!',
                        showCancelButton: true,
                        type: 'error',
                        showConfirmButton: false,
                        cancelButtonText: 'OK'
                    });
                }
            },'json');
        });
    });

    $('.btn-flash').mouseover(function(){
        var url = $(this).data('url');
        var model = $(this).data('model');
        var position = $(this).offset();

        var heightDiv = $('.view-vehicle').height();
        var heightTela = window.innerHeight;

        if((position.top + heightDiv) > heightTela){
            $('.view-vehicle').css('top', position.top - heightDiv - 80);
        } else {
            $('.view-vehicle').css('top', position.top);
        }

        $('.view-vehicle > h4').html(model);
        $('.view-vehicle > img').attr('src', webroot + url);
        $('.view-vehicle').show();
    }).mouseout(function(){
        $('.view-vehicle').hide();
    });
</script>
