<?php
use Migrations\AbstractMigration;

class AlterTableVehiclesAddColumnPicture extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE vehicles add column picture VARCHAR(255)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "ALTER TABLE vehicles drop column picture";

        $this->execute($sql);
    }
}
