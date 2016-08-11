<?php
use Migrations\AbstractMigration;

class CreateTableServices extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `services` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `vehicle_id` INT NOT NULL,
                  `service_type` CHAR NOT NULL,
                  `description` VARCHAR(255) NOT NULL,
                  `make_km` FLOAT NOT NULL,
                  `make_date` DATE NOT NULL,
                  `value` FLOAT NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `vehicle_id_services`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table services";

        $this->execute($sql);
    }
}
