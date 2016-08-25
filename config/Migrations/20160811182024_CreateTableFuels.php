<?php
use Migrations\AbstractMigration;

class CreateTableFuels extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `fuels` (
                `id`  int NOT NULL AUTO_INCREMENT ,
                `name`  varchar(255) NULL ,
                PRIMARY KEY (`id`)
                )
                ;";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table fuels";

        $this->execute($sql);
    }
}
