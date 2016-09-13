<?php
use Migrations\AbstractMigration;

class CreateModuleTickets extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Multas','Tickets','index','clipboard', 'tickets',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Tickets'";

        $this->execute($sql);
    }
}
