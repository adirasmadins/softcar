<div class="row">
    <div class="col-md-6 graph">
        <h4 class="text-center">Gráfico de Serviços/Manutenção por Veículo</h4>
        <hr/>
    </div>
    <div class="col-md-6">
        <h4 class="text-center">Relatório de Manutenção por Veículo</h4>
        <hr/>
        <?= $this->Form->create(null,['id' => 'formExport']) ?>
        <div class="row">
            <div class="col-md-12">
                <?= $this->Form->input('vehicle._ids',['label' => 'Veículo', 'class' => 'form-control','options' => $vehicles,'default' => array_keys($vehicles->toArray())]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $this->Form->input('from_date',['label' => 'Data Inicial','class' => 'form-control','type' => 'text']) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->input('to_date',['label' => 'Data Final','class' => 'form-control','type' => 'text']) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->input('service_type',['label' => 'Tipo de Serviço','class' => 'form-control','options' => ['r' => 'Revisão', 't' => 'Troca de Óleo', 'o' => 'Outros', 'todos' => 'Todos']]) ?>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <a href="#" id="download" class="btn btn-success" style="display: none">
                    <i class="fa fa-download"></i>
                    Baixar Relatório
                </a>
                <button class="btn btn-info pull-right" id="generateFile">
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
    'exportTickets',
    '../dist/iCheck/square/blue'
]));
$this->append('script', $this->Html->script([
    'form',
    '../dist/iCheck/icheck',
    '../dist/chartjs/Chart.bundle.min',
    '../dist/chartjs/Chart.min',
    'chart',
    'exportServices'
]));
?>