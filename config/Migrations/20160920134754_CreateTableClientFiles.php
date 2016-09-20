<?php
use Migrations\AbstractMigration;

class CreateTableClientFiles extends AbstractMigration
{
    public function up(){
        $sql = "CREATE TABLE `client_files` (
                `id`  int NOT NULL AUTO_INCREMENT,
                `client_id`  int NULL ,
                `url_file`  varchar(255) NULL ,
                PRIMARY KEY (`id`),
                CONSTRAINT `client_id_files` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
                );";
                
        $this->execute($sql);
    }
    
    public function down(){
        $sql = "DROP TABLE client_files";
        $this->execute($sql);
    }
}
