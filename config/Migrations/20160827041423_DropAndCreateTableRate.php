<?php
use Migrations\AbstractMigration;

class DropAndCreateTableRate extends AbstractMigration
{
    public function up(){
        $sql = "   DROP TABLE rate_payments;
                   DROP TABLE rates;

                   CREATE TABLE `rates` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `vehicle_id` INT NOT NULL,
                  `referent_year` INT,
                  `ipva_value` VARCHAR(20),
                  `ipva_expiration` DATE,
                  `depvat_value` VARCHAR(20),
                  `depvat_expiration` DATE,
                  `licensing_value` VARCHAR(20),
                  `licensing_expiration` DATE,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `vehicle_id_rates`
                    FOREIGN KEY (`vehicle_id`)
                    REFERENCES `vehicles` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION);

                    CREATE TABLE `rate_payments` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `rate_id` INT NOT NULL,
                  `type` VARCHAR(45) NOT NULL,
                  `payment_date` DATE NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `rate_id_rate_payments`
                    FOREIGN KEY (`rate_id`)
                    REFERENCES `rates` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION);
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "";

        $this->execute($sql);
    }
}
