<?php
use Migrations\AbstractMigration;

class CreateTableReserves extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `reserves` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `client_id` INT NOT NULL,
                  `vehicle_id` INT NOT NULL,
                  `date_start` DATE NOT NULL,
                  `date_end` DATE NOT NULL,
                  `remove_schedule` TIME NOT NULL,
                  `devolution_schedule` TIME NOT NULL,
                  `reserve_date` DATE NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `client_id_reserves`
                    FOREIGN KEY (`client_id`)
                    REFERENCES `clients` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `vehicles_id_reserves`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table reserves";

        $this->execute($sql);
    }
}
