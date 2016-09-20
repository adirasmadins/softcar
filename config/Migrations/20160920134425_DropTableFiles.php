<?php
use Migrations\AbstractMigration;

class DropTableFiles extends AbstractMigration
{
     public function up(){
        $sql = "
                DROP TABLE client_files;
                DROP TABLE files";
        
        $this->execute($sql);
    }
}
