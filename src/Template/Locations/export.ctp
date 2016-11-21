<div class="row">
    <div class="col-md-6 graph">
        <h4 class="text-center">Gráfico de Locação por Veículo</h4>
        <button id="update-graph" class="update-graph"><i class="fa fa-refresh"></i></button>
        <hr/>
    </div>
    <div class="col-md-6">
        <h4 class="text-center">Relatório de Locação por Veículo</h4>
        <hr/>
        <?= $this->Form->create(null,['id' => 'formExport']) ?>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->input('vehicle._ids',['label' => 'Veículo', 'class' => 'form-control','options' => $vehicles, 'default' => array_keys($vehicles)]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $this->Form->input('out_date',['label' => 'Data de Saída','class' => 'form-control','type' => 'text']) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->input('return_date',['label' => 'Data de Devolução','class' => 'form-control','type' => 'text']) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->input('status',['label' => 'Situação','class' => 'form-control','options' => ['0' => 'Em andamento', '1' => 'Finalizadas', 'todos' => 'Todas']]) ?>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <a href="#" id="download" class="btn btn-success" style="display: none">
                    <i class="fa fa-download"></i>
                    Baixar Relatório
                </a>
            </div>
            <div class="col-md-4 col-xs-12">
                <a href="#" class="btn btn-info" id="generatePdf">
                    <i class="fa fa-file-pdf-o"></i>
                    Exportar Gráfico
                </a>
                <a href="#" class="btn btn-success" id="abrir" style="display:none">
                    <i class="fa fa-file-pdf-o"></i>
                    Abrir PDF
                </a>
            </div>
            <div class="col-md-4 col-xs-12">
                <button class="btn btn-info" id="generateFile">
                    <i class="fa fa-file-excel-o"></i>
                    Gerar Relatorio
                </button>
            </div>
        </div>
        <?= $this->Form->end(); ?>
        <div class="row" style="margin-top: 40px">
            <div class="col-md-12 text-center">
                <h4>Tipo de exibição do gráfico</h4>
                <label for="bar">
                    <input type="radio" value="bar" id="bar" name="type" class="form-control" checked>
                    Em Barras
                </label>

                <label for="polarArea">
                    <input type="radio" value="polarArea" name="type" id="polarArea" class="form-control">
                    Em Polos
                </label>

                <label for="pie">
                    <input type="radio" value="pie" name="type" id="pie" class="form-control">
                    Em Pizza
                </label>

                <label for="doughnut">
                    <input type="radio" value="doughnut" name="type" id="doughnut" class="form-control">
                    Em Rosca
                </label>
            </div>
        </div>
    </div>
</div>

<?php
$this->append('css', $this->Html->css([
    'exportLocations',
    '../dist/iCheck/square/blue'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/iCheck/icheck',
    '../dist/chartjs/Chart.bundle.min',
    '../dist/chartjs/Chart.min',
    'colorLib',
    'chart',
    'exportLocations'
]));
?>
