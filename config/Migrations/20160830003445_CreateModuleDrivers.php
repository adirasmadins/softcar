<?php
use Migrations\AbstractMigration;

class CreateModuleDrivers extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Motorista Terceirizado','Drivers','index','hand-paper-o', 'drivers',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Drivers'";

        $this->execute($sql);
    }
}
