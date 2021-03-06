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
                  `cpf` VARCHAR (45),
                  `rg` VARCHAR(45),
                  `street` VARCHAR(255),
                  `number` INT,
                  `neighborhood` VARCHAR(255),
                  `phone` VARCHAR(45),
                  `cel_phone` VARCHAR(45),
                  `profile_id` INT,
                  `cep` VARCHAR (45),
                  `city_id` INT,
                  `state_id` INT,
                  `login` VARCHAR(45),
                  `password` VARCHAR(255),
                  `status` int,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `profile_id_users`
                    FOREIGN KEY (`profile_id`)
                    REFERENCES `profiles` (`id`),
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
