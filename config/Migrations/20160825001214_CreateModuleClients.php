<?php
use Migrations\AbstractMigration;

class CreateModuleClients extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Clientes','Clients','index','user', 'clients',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Clients'";

        $this->execute($sql);
    }
}

