<?php
use Migrations\AbstractMigration;

class CreateModuleReportServices extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Serviços e Manutenção','Services','export', null, 'services', 11,'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where text = 'Serviços e Manutenção';";

        $this->execute($sql);
    }
}
