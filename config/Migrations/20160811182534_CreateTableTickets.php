<?php
use Migrations\AbstractMigration;

class CreateTableTickets extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `tickets` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `vehicle_id` INT NOT NULL,
                  `client_id` INT NOT NULL,
                  `client_not_registered` VARCHAR(255) NULL,
                  `due_date` DATE NOT NULL,
                  `value` FLOAT NULL,
                  `description` TEXT NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `vehicle_id_tickets`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `client_id_tickets`
                    FOREIGN KEY (`client_id`)
                    REFERENCES `clients` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table tickets";

        $this->execute($sql);
    }
}
