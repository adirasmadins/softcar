<header class="main-header">

    <a href="<?= $this->Url->build('/dashboard', true); ?>" class="logo" style="font-family: 'Source Sans Pro Bold', sans-serif;">
        <span class="logo-mini">
            <img
                src="<?= $this->Url->build('/img/logo-header.png', true); ?>"
                class="img-responsive center-block pull-left"
                width="40px"
                style="margin-top: 5px;margin-left: 5px"
            />
        </span>
        <span class="logo-lg">
            <img
                src="<?= $this->Url->build('/img/logo-header.png', true); ?>"
                class="img-responsive center-block pull-left"
                width="40px"
                style="margin-top: 5px"
            />
            <b>SoftCar</b>
        </span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only hidden-md hidden-sm">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <?php if($rates_list || $tickets_list): ?>
                            <span class="label label-warning"><?= count($rates_list) + count($tickets_list) ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Você tem <?= count($rates_list) + count($tickets_list) ?> notificações</li>
                        <li>
                            <ul class="menu">
                                <?php if($rates_list): ?>
                                    <?php foreach($rates_list as $key => $rate): ?>
                                        <li class="rates" data-id="<?= $rate['id'] ?>">
                                            <a href="<?= $this->Url->build('/rates/edit/' . $rate['id'],true); ?>">
                                                <i class="fa fa-area-chart text-yellow"></i>
                                                Tarifa #<?= $rate['id'] ?> vence dentro dos próximos 30 dias <small>(<?= $rate['vehicle'] . ' / ' . $rate['plate'] ?>)</small>
                                            </a>
                                        </li>
                                        <div class="text-center rate-days-<?= $rate['id'] ?>" style="display: none;margin-bottom: 10px;padding-left: 10px">
                                            <?php
                                            if(isset($rate['ipva'])){
                                                $rates_days ['IPVA'] = $rate['ipva'];
                                                if($rate['ipva_status'] == 1){
                                                    unset($rates_days['IPVA']);
                                                }
                                            } else {
                                                unset($rates_days['IPVA']);
                                            }
                                            if(isset($rate['dpvat'])){
                                                $rates_days ['DPVAT'] = $rate['dpvat'];
                                                if($rate['dpvat_status'] == 1){
                                                    unset($rates_days['DPVAT']);
                                                }
                                            } else {
                                                unset($rates_days['DPVAT']);
                                            }
                                            if(isset($rate['licensing'])){
                                                $rates_days ['Licenciamento'] = $rate['licensing'];
                                                if($rate['licensing_status'] == 1){
                                                    unset($rates_days['Licenciamento']);
                                                }
                                            } else {
                                                unset($rates_days['Licenciamento']);
                                            }
                                            ?>
                                            <?php foreach($rates_days as $name => $days):?>
                                                <span class="label label-<?= $days == 1 ? 'danger' : 'warning' ?>" style="margin-bottom: 5px"><?= $name ?>: <?= $days == 1 ? 'Falta' : 'Faltam' ?> <?= $days == 1 ? $days . ' dia' : $days . ' dias'?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if($tickets_list): ?>
                                    <?php foreach($tickets_list as $ticket): ?>
                                        <li>
                                            <a href="<?= $this->Url->build('/tickets/?plate=' . $ticket['plate'],true); ?>">
                                                <i class="fa fa-clipboard text-aqua"></i>
                                                Multa #<?= $ticket['id'] ?> vence
                                                <?php
                                                if($ticket['days'] == 1){
                                                    echo 'amanhã';
                                                } else if($ticket['days'] == 0){
                                                    echo 'hoje!';
                                                } else {
                                                    echo 'dentro de ' . $ticket['days'] . ' dias';
                                                }
                                                ?>
                                                <small>(<?= $ticket['vehicle'] . ' / ' . $ticket['plate'] ?>)</small>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php $user_first_name = (explode(" ",$user_online['name'])) ?>
                        <i class="fa fa-user"></i><span class="hidden-xs"><?= $user_first_name[0] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?= $user_online['name'] ?> - <?= $user_online['profile_name'] ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat btn-sair">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<style>
    @media(max-width: 768px){
        .navbar-nav > .notifications-menu > .dropdown-menu{
            width: 300px;
            font-size: 11px !important;
        }
    }
</style>
<script>
    var user = '<?= $user_online['name'] ?>';

    $('.rates').mouseover(function(){
        var id = $(this).data('id');
        $('.rate-days-' + id).show('100');
    }).mouseout(function(){
        var id = $(this).data('id');
        $('.rate-days-' + id).hide();
    });

</script>