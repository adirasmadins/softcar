<?php
use Migrations\AbstractMigration;

class AddColumnNeighborhoodInClient extends AbstractMigration
{
    public function up(){
        $sql="ALTER TABLE clients ADD COLUMN neighborhood VARCHAR(45)";
        $this->execute($sql);

    }
}
