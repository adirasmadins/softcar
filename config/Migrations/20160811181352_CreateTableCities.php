<?php
use Migrations\AbstractMigration;

class CreateTableCities extends AbstractMigration
{
    public function up()
    {
        $sql = "
                CREATE TABLE `cities` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `state_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                    CONSTRAINT `state_id_cities`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `states` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table cities";

        $this->execute($sql);
    }
}
