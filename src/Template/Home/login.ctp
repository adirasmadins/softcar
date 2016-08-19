<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SoftCar</title>

    <?php
    echo $this->Html->css([
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
<div class="login-box">
    <div class="login-logo">
        <img src="../img/logo.png" class="img-responsive center-block" width="200px"/>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Identifique-se para utilizar o sistema</p>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" id="login" name="login" placeholder="Usuário">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback" style="margin-top: 10px">
            <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="col-md-6 pull-right">
                <button type="button" id="logar" class="btn btn-block btn-success pull-right">Entrar</button>
            </div>
            <div class="col-md-6" style="margin-top: 5px">
                <a href="#" id="esqueci-senha">Esqueci minha senha</a><br>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>
<?php
echo $this->fetch('script');
echo $this->Html->script([
    '../dist/jQuery/jQuery-2.1.4.min',
    '../dist/bootstrap/js/bootstrap.min',
    '../dist/bootstrap-sweetalert/dist/sweetalert.min',
    'login'
]);
?>
</body>
</html>
<script>
    var webroot = '<?= $this->request->webroot ?>';
</script>
