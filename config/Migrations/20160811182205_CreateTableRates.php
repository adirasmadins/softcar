<?php
use Migrations\AbstractMigration;

class CreateTableRates extends AbstractMigration
{
    public function up()
    {
        $sql = "
                CREATE TABLE `rates` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `vehicle_id` INT NOT NULL,
                  `referent_year` INT,
                  `ipva_value` FLOAT,
                  `ipva_expiration` DATE,
                  `depvat_value` FLOAT,
                  `depvat_expiration` DATE,
                  `licensing_value` FLOAT,
                  `licensing_expiration` DATE,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `vehicle_id_rates`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table rates";

        $this->execute($sql);
    }
}
