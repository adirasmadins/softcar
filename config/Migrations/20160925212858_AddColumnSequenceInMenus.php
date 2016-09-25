<?php
use Migrations\AbstractMigration;

class AddColumnSequenceInMenus extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE menus ADD COLUMN sequence INTEGER";
        $this->execute($sql);
    }
}
