<?php
use Migrations\AbstractMigration;

class AddColumnStatusInReserves extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE reserves ADD COLUMN status INT NULL AFTER vehicle_id";
        $this->execute($sql);
    }
}
