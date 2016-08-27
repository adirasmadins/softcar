<?php
use Migrations\AbstractMigration;

class CreateModuleServices extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Serviços e Manutenção','Services','index','tachometer', 'services',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Services'";

        $this->execute($sql);
    }
}
