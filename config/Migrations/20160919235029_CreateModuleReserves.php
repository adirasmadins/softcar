<?php
use Migrations\AbstractMigration;

class CreateModuleReserves extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Reservas','Reserves','index','calendar', 'reserves',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Reserves'";

        $this->execute($sql);
    }
}
