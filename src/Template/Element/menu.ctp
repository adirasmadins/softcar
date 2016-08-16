<ul class="sidebar-menu">
    <?php foreach($NavMenus as $menu): ?>
        <?php if(empty($menu['children'])): ?>
            <li>
                <a href="<?= $this->Url->build("/". $menu['route'] ."/" . $menu['action']); ?>">
                    <i class="fa fa-<?= $menu['icon'] ?>"></i>
                    <span><?= $menu['text']; ?></span>
                </a>
            </li>
        <?php endif ?>

        <?php if (count($menu['children']) && !empty($menu['children'])): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-<?= $menu['icon'] ?>"></i>
                    <span><?= $menu['text']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <?php foreach($menu['children'] as $child): ?>
                        <li>
                            <a href="<?= $this->Url->build("/". $child['route'] ."/" . $child['action']); ?>">
                                <?= $child['text'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif ?>
    <?php endforeach; ?>
</ul>
