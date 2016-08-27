<?php
use Migrations\AbstractMigration;

class CreateModuleRates extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Tarifas','Rates','index','area-chart', 'rates',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Rates'";

        $this->execute($sql);
    }
}
