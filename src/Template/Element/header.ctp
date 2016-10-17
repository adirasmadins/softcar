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
                        <i class="fa fa-bell-o"></i> <span class="hidden-sm hidden-xs">Notificações</span>
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
                                            $rates_days ['IPVA'] = 0;
                                            $rates_days ['DPVAT'] = 0;
                                            $rates_days ['Licenciamento'] = 0;
                                            if(isset($rate['ipva'])){
                                                $rates_days ['IPVA'] = $rate['ipva'];
                                            } else {
                                                unset($rates_days['IPVA']);
                                            }

                                            if(isset($rate['dpvat'])){
                                                $rates_days ['DPVAT'] = $rate['dpvat'];
                                            } else {
                                                unset($rates_days['DPVAT']);
                                            }

                                            if(isset($rate['licensing'])){
                                                $rates_days ['Licenciamento'] = $rate['licensing'];
                                            } else {
                                                unset($rates_days['Licenciamento']);
                                            }
                                            ?>
                                            <?php foreach($rates_days as $name => $days):?>
                                                <span
                                                    class="label label-<?= $days == 1 || $days == 0 ? 'danger' : 'warning' ?>"
                                                    style="margin: 5px">
                                                    <?= $name ?>:
                                                    <?php
                                                    if($days == 0){
                                                        echo ' Hoje!';
                                                    } else if ($days == 1) {
                                                        echo ' Amanhã!';
                                                    } else {
                                                        echo ' Faltam ' . $days . ' dias';
                                                    }
                                                    ?>
                                                </span>
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
                        <i class="fa fa-bar-chart"></i>
                        <span class="hidden-sm hidden-xs">Estatísticas<span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Estatísticas</li>
                        <li>
                            <ul class="menu" style="padding: 10px;">
                                    <a>
                                        <h5>
                                            <i class="fa fa-car"></i> Porcentagem de veículos locados no momento
                                        </h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-yellow" style="width: <?= str_replace(',','.',$percentual) ?>%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="<?= $percentual > 1 ? 'perc-1' : 'perc-0' ?>"><?= $percentual ?>%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php $user_first_name = (explode(" ",$user_online['name'])) ?>
                        <i class="fa fa-user"></i><span class="hidden-xs">Olá, <?= $user_first_name[0] ?></span>
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
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-sair"><i class="fa fa-sign-out"></i> Sair</a>
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
    .menu a{
        color: #606060 !important;
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