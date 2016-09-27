<?php
use Migrations\AbstractMigration;

class CreateModuleContract extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Contrato','Contract','view', null, 'contract', 2,'default');";
                              
        $this->execute($sql);
    }
}
