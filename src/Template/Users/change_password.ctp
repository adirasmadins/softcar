<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SoftCar</title>

    <?php
    echo $this->Html->css([
        '_fonts/stylesheet',
        '../dist/bootstrap/css/bootstrap.min',
        '../dist/font-awesome/css/font-awesome.min',
        '../dist/bootstrap-sweetalert/dist/sweetalert',
        '../dist/admin-lte/css/AdminLTE'
    ]);
    ?>
</head>
<body class="hold-transition login-page" style="overflow: hidden">

<?= $this->Flash->render() ?>
<?= $this->Form->create(null,['id' => 'formLogin']) ?>

<div class="register-box">
    <div class="register-logo">
        <b>Recuperação de Senha</b>
    </div>

    <div class="register-box-body">
        <?= $this->Form->create($user,['id' => 'formRecuperarSenha']) ?>
        <input type="hidden" value="<?= $user->id ?>" name="id" id="id-user">
        <div class="form-group has-feedback">
            <?= $this->Form->input('name',['label' => false,'placeholder' => 'Nome','class' => 'form-control','disabled' => 'disabled']) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('login',['label' => false,'placeholder' => 'Login','class' => 'form-control','disabled' => 'disabled']) ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('email',['label' => false,'placeholder' => 'Email','class' => 'form-control','disabled' => 'disabled']) ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <hr/>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password-new" placeholder="Digite a nova senha"/>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password-new-repeat" placeholder="Repita a nova senha"/>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback warning-icon" style="display: none"></span>
            <span class="glyphicon glyphicon-ok form-control-feedback success-icon" style="display: none"></span>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <?= $this->Html->link('<i class="fa fa-undo"></i> Voltar ao Login',['action' => 'login'],['class' => 'btn btn-block btn-default pull-left','escape' => false]) ?>
            </div>
            <div class="col-md-6 col-xs-6">
                <button type="button" class="btn btn-block btn-success pull-right" id="recuperar"><i class="fa fa-check"></i> Recuperar Senha</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <!-- /.form-box -->
</div>

<?= $this->Form->end() ?>
<?php
echo $this->fetch('script');
echo $this->Html->script([
    '../dist/jQuery/jQuery-2.1.4.min',
    '../dist/bootstrap/js/bootstrap.min',
    '../dist/bootstrap-sweetalert/dist/sweetalert.min',
    'formRecuperarSenha'
]);
?>
</body>
</html>
<style>
    .form-group{
        margin-bottom: 20px;
    }
</style>
<script>
    var webroot = '<?= $this->request->webroot ?>';
</script>
