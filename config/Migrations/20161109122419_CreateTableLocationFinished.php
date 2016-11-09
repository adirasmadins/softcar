<?php
use Migrations\AbstractMigration;

class CreateTableLocationFinished extends AbstractMigration
{
    public function up(){
        $sql = "CREATE TABLE `location_finished` (
                `id`  int NOT NULL AUTO_INCREMENT ,
                `location_id`  int NULL ,
                `finish_value`  float NULL ,
                `finish_km`  float NULL ,
                `finish_tank`  varchar(255) NULL ,
                PRIMARY KEY (`id`));";
        $this->execute($sql);
    }
}
