<?php
use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `users` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255),
                  `gender` CHAR,
                  `birth_date` DATE,
                  `cpf` INT,
                  `rg` INT,
                  `street` VARCHAR(255),
                  `number` INT,
                  `neighborhood` VARCHAR(255),
                  `phone` VARCHAR(45),
                  `cel_phone` VARCHAR(45),
                  `city_id` INT,
                  `state_id` INT,
                  `profile` VARCHAR(45),
                  `login` VARCHAR(45),
                  `password` VARCHAR(255),
                  PRIMARY KEY (`id`),
                  CONSTRAINT `city_id_users`
                    FOREIGN KEY (`city_id`)
                    REFERENCES `cities` (`id`),
                  CONSTRAINT `state_id_users`
                    FOREIGN KEY (`state_id`)
                    REFERENCES `states` (`id`)
                  )";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table users";

        $this->execute($sql);
    }
}
