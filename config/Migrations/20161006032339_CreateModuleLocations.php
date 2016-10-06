<?php
use Migrations\AbstractMigration;

class CreateModuleLocations extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Locações','Locations','index','check-circle-o', 'locations',null, 'default');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM menus where controller = 'Locations'";

        $this->execute($sql);
    }
}
