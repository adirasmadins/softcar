<?php
use Migrations\AbstractMigration;

class CreateModuleFuels extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Combustíveis','Fuels','index', null, 'fuels', 2,'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where controller = 'Fuels';";

        $this->execute($sql);
    }
}
