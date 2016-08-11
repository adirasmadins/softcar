<?php
use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `users` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `gender` CHAR NOT NULL,
                  `birth_date` DATE NOT NULL,
                  `cpf` INT NOT NULL,
                  `rg` INT NOT NULL,
                  `street` VARCHAR(255) NOT NULL,
                  `number` INT NOT NULL,
                  `neighborhood` VARCHAR(255) NOT NULL,
                  `phone` VARCHAR(45) NOT NULL,
                  `cel_phone` VARCHAR(45) NULL,
                  `city_id` INT NOT NULL,
                  `state_id` INT NULL,
                  `profile` VARCHAR(45) NOT NULL,
                  `login` VARCHAR(45) NOT NULL,
                  `password` VARCHAR(45) NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `city_id_users`
                    FOREIGN KEY (`city_id`)
                    REFERENCES `cities` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION,
                  CONSTRAINT `state_id_users`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `states` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table users";

        $this->execute($sql);
    }
}
