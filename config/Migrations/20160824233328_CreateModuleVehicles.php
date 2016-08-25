<?php
use Migrations\AbstractMigration;

class CreateModuleVehicles extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Veículos','Vehicles','index','car', 'vehicles',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Vehicles'";

        $this->execute($sql);
    }
}
