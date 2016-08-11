<?php
use Migrations\AbstractMigration;

class CreateTableClients extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `clients` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `phone` VARCHAR(45) NOT NULL,
                  `cel_phone` VARCHAR(45) NULL,
                  `rg_ie` VARCHAR(45) NOT NULL,
                  `cpf_cnpj` FLOAT(14) NOT NULL,
                  `gender` CHAR NOT NULL,
                  `birth_date` DATE NOT NULL,
                  `street` VARCHAR(45) NOT NULL,
                  `number` INT NOT NULL,
                  `city_id` INT NOT NULL,
                  `state_id` INT NULL,
                  `cep` VARCHAR(8) NOT NULL,
                  `cnh` INT(11) NOT NULL,
                  `validity_cnh` DATE NOT NULL,
                  `first_license` DATE NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `city_id_clients`
                    FOREIGN KEY (`city_id`)
                    REFERENCES `cities` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `state_id_clients`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `states` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table clients";

        $this->execute($sql);
    }
}
