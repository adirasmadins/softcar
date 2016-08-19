<?php
$a = $options['name']
?>
<div class="row">
    <div class="box">
        <div class="box-body">
            <?= $this->Form->create(${$options['variavel']}, ['type' => 'get']) ?>
            <div class="col-md-8 col-xs-12">
                <div class="input-group input-group-sm" style="margin-top: 5px;">
                    <input type="text" class="form-control" id="name" name="name" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" id="busca-header" type="submit" style="height: 40px;">
                                <i class="fa fa-search fa-fw"></i>
                            </button>
                        </span>
                </div>
            </div>
            <div class="col-md-4">
                <?= $this->Html->link(__('<i class="fa fa-plus"></i> Cadastrar ' . $a), ['action' => 'add'], ['class' => 'btn btn-success margin pull-right','escape' => false]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $('form').submit(function() {
        $('#busca-header').html('<i class="fa fa-spinner fa-spin fa-fw"></i>').attr('disabled',true);
    });
</script>