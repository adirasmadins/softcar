<?php
use Migrations\AbstractMigration;

class CreateTableStates extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `states` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NULL,
                `state_cod` CHAR(2) NULL,
                PRIMARY KEY (`id`))";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table states";

        $this->execute($sql);
    }
}
