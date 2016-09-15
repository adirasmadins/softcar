<?php
use Migrations\AbstractMigration;

class CreateModuleCities extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Cidades','Cities','index', null, 'cities', 2,'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where controller = 'Cities';";

        $this->execute($sql);
    }
}
