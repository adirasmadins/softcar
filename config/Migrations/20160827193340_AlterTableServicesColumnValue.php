<?php
use Migrations\AbstractMigration;

class AlterTableServicesColumnValue extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE services drop column value;
                ALTER TABLE services add column value VARCHAR(45);";

        $this->execute($sql);
    }
}
