<?php
use Migrations\AbstractMigration;

class DeleteTableFiles extends AbstractMigration
{
     public function up(){
        $sql = "DELETE FROM files";
        
        $this->execute($sql);
    }
}
