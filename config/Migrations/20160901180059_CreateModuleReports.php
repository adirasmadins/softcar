<?php
use Migrations\AbstractMigration;

class CreateModuleReports extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (11, 'Relatórios', null,null,'file-pdf-o', null, null, 'parent');
                INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Multas','Tickets','export', null, 'tickets', 11,'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where text = 'Relatórios';";

        $this->execute($sql);
    }
}
