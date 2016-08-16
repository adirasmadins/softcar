<?php
use Migrations\AbstractMigration;

class CreateTableProfiles extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `profiles` (
                `id`  int NOT NULL AUTO_INCREMENT ,
                `name`  varchar(255) NULL ,
                PRIMARY KEY (`id`)
                )
                ;";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table profiles";

        $this->execute($sql);
    }
}
