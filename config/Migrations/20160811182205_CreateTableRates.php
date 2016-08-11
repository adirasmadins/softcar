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
                  `referent_year` DATE NOT NULL,
                  `ipva_value` FLOAT NOT NULL,
                  `ipva_expiration` DATE NOT NULL,
                  `depvat_value` FLOAT NOT NULL,
                  `depvar_vencimento` DATE NOT NULL,
                  `licensing_value` FLOAT NOT NULL,
                  `licensing_expiration` DATE NOT NULL,
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
