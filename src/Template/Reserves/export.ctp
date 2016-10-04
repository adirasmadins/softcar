<div class="row">
    <div class="col-md-6">
        <h4 class="text-center">Relatório de Reservas por Veículo</h4>
        <hr/>
        <?= $this->Form->create(null,['id' => 'formExport']) ?>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->input('vehicle._ids',['label' => 'Veículo', 'class' => 'form-control','options' => $vehicles, 'default' => array_keys($vehicles)]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $this->Form->input('date_start',['label' => 'Data Inicial','class' => 'form-control','type' => 'text']) ?>
            </div>
            <div class="col-md-6">
                <?= $this->Form->input('date_end',['label' => 'Data Final','class' => 'form-control','type' => 'text']) ?>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <button class="btn btn-info" id="generateFile">
                    <i class="fa fa-file-excel-o"></i>
                    Gerar Relatorio
                </button>
            </div>
            <div class="col-md-6 col-xs-12">
                <a href="#" id="download" class="btn btn-success pull-right" style="display: none">
                    <i class="fa fa-download"></i>
                    Baixar Relatório
                </a>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>

<?php
$this->append('css', $this->Html->css([
    'exportReserves',
    '../dist/iCheck/square/blue'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/iCheck/icheck',
    '../dist/chartjs/Chart.bundle.min',
    '../dist/chartjs/Chart.min',
    'colorLib',
    'chart',
    'exportReserves'
]));
?>