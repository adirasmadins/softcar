<?php
use Migrations\AbstractMigration;

class CreatTableClientFiles extends AbstractMigration
{
     public function up(){
        $sql = "CREATE TABLE client_files (
            id int NOT NULL AUTO_INCREMENT,
            client_id int NOT NULL,
            file_id int NOT NULL,
            
            PRIMARY KEY(id),
            CONSTRAINT client_id_1 FOREIGN KEY (client_id) REFERENCES clients (id),
            CONSTRAINT file_id_1 FOREIGN KEY (file_id) REFERENCES files (id));
            ";
            $this->execute($sql);
        
    }
}
