<div class="col-md-10">
    <div class="panel panel-default">
        <?= $this->Form->create($user,['id' => 'formUsers']) ?>
        <div class="box-header hidden-sm hidden-xs">
            <h4 class="panel-head"><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="box-header hidden-md hidden-lg text-center">
            <h4><?= $situacao ?></h4>
            <hr/>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 form-group">
                    <?= $this->Form->input('name',['label' => 'Nome','placeholder' => 'Nome','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('gender',['label' => 'Sexo','placeholder' => 'Status','class' => 'form-control','options' => ['m' => 'Masculino','f' => 'Feminino']]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $this->Form->input('cpf',['label' => 'CPF','placeholder' => 'CPF','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('rg',['label' => 'RG','placeholder' => 'RG','class' => 'form-control','type' => 'text']) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->input('birth_date',['label' => 'Data de Nascimento','placeholder' => 'Data de Nascimento','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?= $this->Form->input('status',['label' => 'Status','placeholder' => 'Status','class' => 'form-control','options' => ['1' => 'Ativo','0' => 'Inativo']]) ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('phone',['label' => 'Telefone','placeholder' => 'Telefone','class' => 'form-control']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= $this->Form->input('cel_phone',['label' => 'Celular','placeholder' => 'Celular','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('email',['label' => 'Email','placeholder' => 'Email','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('state_id',['label' => 'Estado','placeholder' =>'Estado', 'class' => 'form-control','options' => $states,'empty' => 'Selecione um estado']); ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('city_id',['label' => 'Cidade','placeholder' =>'Cidade', 'class' => 'form-control','empty' => 'Escolha um estado...','disabled' => 'disabled']); ?>
                    <input type="hidden" id="city-id-hidden" value="<?= $user->city_id ?>"/>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('cep',['label' => 'CEP','placeholder' => 'CEP','class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $this->Form->input('street',['label' => 'Rua','placeholder' => 'Rua','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $this->Form->input('neighborhood',['label' => 'Bairro','placeholder' => 'Bairro','class' => 'form-control']) ?>
                </div>
                <div class="col-md-2">
                    <?= $this->Form->input('number',['label' => 'Número','placeholder' => 'Número','class' => 'form-control','type' => 'text']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('profile_id', ['label' => 'Perfil','placeholder' => 'Perfil','class' => 'form-control','options' => $profiles,'empty' => 'Selecione o perfil']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('login', ['label' => 'Login','placeholder' => 'Login','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4 form-group">
                    <?= $this->Form->input('password', ['label' => 'Senha','placeholder' => 'Senha','class' => 'form-control']) ?>
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
$this->append('script', $this->Html->script([
    'form',
    'formUsers'
]));
?>