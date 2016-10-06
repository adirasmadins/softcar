<?php
use Migrations\AbstractMigration;

class CreateReportLocations extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Locações','Locations','export', null, 'locations', 13,'default');";
        $this->execute($sql);
    }
}
