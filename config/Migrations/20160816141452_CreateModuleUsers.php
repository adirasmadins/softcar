<?php
use Migrations\AbstractMigration;

class CreateModuleUsers extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (1, 'Usuários','Users','index','users', 'users',null, 'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where controller = 'Users';";

        $this->execute($sql);
    }
}
