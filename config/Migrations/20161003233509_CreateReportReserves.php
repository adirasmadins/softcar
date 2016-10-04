<?php
use Migrations\AbstractMigration;

class CreateReportReserves extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Reservas','Reserves','export', null, 'reserves', 13,'default');";
        $this->execute($sql);
    }
}
