<?php
use Migrations\AbstractMigration;

class CreateTableFiles extends AbstractMigration
{
    public function up(){
        $sql = "CREATE TABLE files (
            id int NOT NULL AUTO_INCREMENT,
            url_file varchar(250) NOT NULL,
            PRIMARY KEY(id));
            ";
            $this->execute($sql);
        
    }
}
