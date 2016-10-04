<?php
use Migrations\AbstractMigration;

class ReseolveUrlContract2 extends AbstractMigration
{
    public function up(){
        $sql = "UPDATE menus SET route = 'contract' WHERE text = 'Contrato';
                UPDATE menus SET action = 'edit' WHERE text ='Contrato'";
        $this->execute($sql);
    }
}
