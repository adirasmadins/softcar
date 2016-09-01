<div class="row">
    <div class="col-md-6 graph">
        <h4 class="text-center">Gráfico de Veículos multados</h4>
        <hr/>
    </div>
    <div class="col-md-6">
        <h4 class="text-center">Relatório de Multas por Veículo</h4>
        <hr/>
        <div class="col-md-12">
            <?= $this->Form->input('vehicle_id',['label' => 'Veículo', 'class' => 'form-control','options' => $vehicles,'empty' => 'Todos os veículos']); ?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->input('from_date',['label' => 'Data Inicial','class' => 'form-control','type' => 'text']) ?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->input('to_date',['label' => 'Data Final','class' => 'form-control','type' => 'text']) ?>
        </div>
        <div class="col-md-12">
            <a href="#" id="download" class="btn btn-success" style="display: none"><i class="fa fa-download"></i> Baixar Relatório</a>
            <button class="btn btn-info pull-right" id="generateFile"><i class="fa fa-file-excel-o"></i> Gerar Relatorio</button>
        </div>
    </div>
</div>

<?php
$this->append('script', $this->Html->script([
    'form',
    '../dist/chartjs/Chart.bundle.min',
    '../dist/chartjs/Chart.min',
    'exportTickets'
]));
?>