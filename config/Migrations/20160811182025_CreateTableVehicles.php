<?php
use Migrations\AbstractMigration;

class CreateTableVehicles extends AbstractMigration
{
    public function up()
    {
        $sql = "
                CREATE TABLE `vehicles` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `plate` VARCHAR(8) NOT NULL,
                  `chassi` VARCHAR(17) NOT NULL,
                  `renavam` FLOAT NOT NULL,
                  `type_id` INT NOT NULL,
                  `fuel` VARCHAR(45) NOT NULL,
                  `mark` VARCHAR(45) NOT NULL,
                  `model` VARCHAR(255) NOT NULL,
                  `date_fabrication` INT NOT NULL,
                  `date_model` INT NOT NULL,
                  `color` VARCHAR(45) NOT NULL,
                  `day_price` FLOAT NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `type_id_vehicles`
                    FOREIGN KEY (`type_id`)
                    REFERENCES `types` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table vehicles";

        $this->execute($sql);
    }
}
