<?php
use Migrations\AbstractMigration;

class CreateTableTypes extends AbstractMigration
{
    public function up()
    {
        $sql = "
                CREATE TABLE `types` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NULL,
                PRIMARY KEY (`id`))";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table types";

        $this->execute($sql);
    }
}
