<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
    /** CSS **/
    $this->prepend('css', $this->Html->css([
        '../dist/bootstrap/css/bootstrap.min',
        '../dist/font-awesome/css/font-awesome.min',
        '../dist/bootstrap-sweetalert/dist/sweetalert'
    ]));
    $this->append('css', $this->Html->css([
        '../dist/admin-lte/css/AdminLTE',
        '../dist/admin-lte/css/skins/skin-black',
        '../dist/select2/select2.min',
        '../dist/datepicker/datepicker3',
        'style',
        'form'
    ]));
    echo $this->fetch('css');
    ?>
    <script>
        var webroot = '<?= $this->request->webroot ?>';
    </script>
    <?php
    /** JAVA SCRIPT **/

    echo $this->prepend('script', $this->Html->script([
        '../dist/jQuery/jQuery-2.1.4.min',
        '../dist/jquery-validation/dist/jquery.validate.min',
        '../dist/bootstrap/js/bootstrap.min',
        '../dist/bootstrap-sweetalert/dist/sweetalert.min',
        '../dist/jquery-meiomask/dist/meiomask'
    ]));
    echo $this->append('script', $this->Html->script([
        '../dist/admin-lte/js/app.min',
        '../dist/select2/select2.full',
        '../dist/datepicker/bootstrap-datepicker',
        '../dist/datepicker/locales/bootstrap-datepicker.pt-BR'
    ]));
    echo $this->fetch('script');
    ?>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

</head>
<?= $this->element('header') ?>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
    <?= $this->Flash->render() ?>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?= $this->element('menu') ?>
        </section>
    </aside>
    <div class="content-wrapper" style="min-height: 800px; !important;">
        <section class="content">
            <?= $this->fetch('content') ?>
        </section>
    </div>
</div>
</body>
</html>
