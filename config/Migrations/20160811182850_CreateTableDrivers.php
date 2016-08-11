<?php
use Migrations\AbstractMigration;

class CreateTableDrivers extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `drivers` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `rg` VARCHAR(45) NOT NULL,
                  `cpf` VARCHAR(11) NOT NULL,
                  `gender` CHAR NOT NULL,
                  `birth_date` DATE NOT NULL,
                  `phone` VARCHAR(45) NOT NULL,
                  `cel_phone` VARCHAR(45) NULL,
                  `city_id` INT NOT NULL,
                  `state_id` INT NOT NULL,
                  `cep` VARCHAR(8) NOT NULL,
                  `cnh` INT(11) NOT NULL,
                  `first_license` DATE NOT NULL,
                  `validity_cnh` DATE NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `city_id_drivers`
                    FOREIGN KEY (`city_id`)
                    REFERENCES `cities` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `state_id_drivers`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `states` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table drivers";

        $this->execute($sql);
    }
}
