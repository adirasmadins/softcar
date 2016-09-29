<?php
use Migrations\AbstractMigration;

class ReseolveUrlContract extends AbstractMigration
{
    public function up(){
        $sql = "UPDATE menus SET route = 'edit' WHERE text = 'Contrato'";
        $this->execute($sql);
    }
}
