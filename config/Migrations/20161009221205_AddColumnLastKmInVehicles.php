<?php
use Migrations\AbstractMigration;

class AddColumnLastKmInVehicles extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE vehicles ADD COLUMN last_km VARCHAR(45) NULL";
        $this->execute($sql);
    }
}
