<?php
use Migrations\AbstractMigration;

class CreateTableLocations extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `locations` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `client_id` INT NOT NULL,
                  `vehicle_id` INT NOT NULL,
                  `driver_id` INT NULL,
                  `status` CHAR NOT NULL,
                  `start_value` FLOAT NOT NULL,
                  `total` FLOAT NULL,
                  `form_payment` VARCHAR(45) NULL,
                  `out_date` DATE NULL,
                  `return_date` DATE NULL,
                  `start_km` FLOAT NOT NULL,
                  `free_km` INT NOT NULL,
                  `allowed_km` FLOAT NOT NULL,
                  `tank_check` TEXT NOT NULL,
                  `location_date` DATE NOT NULL,
                  `payment_date` DATE NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `client_id_locations`
                    FOREIGN KEY (`client_id`)
                    REFERENCES `clients` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `vehicle_id_locations`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `driver_id_locations`
                    FOREIGN KEY (`driver_id`)
                    REFERENCES `drivers` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table locations";

        $this->execute($sql);
    }
}
