<?php
use Migrations\AbstractMigration;

class CreateModuleDashboard extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Página Inicial','Dashboard','index','home', 'dashboard',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Dashboard'";

        $this->execute($sql);
    }
}
