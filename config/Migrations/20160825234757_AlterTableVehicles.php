<?php
use Migrations\AbstractMigration;

class AlterTableVehicles extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE vehicles modify day_price VARCHAR(45)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "";

        $this->execute($sql);
    }
}
