<?php
use Migrations\AbstractMigration;

class CreateTableRatePayments extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `rate_payments` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `rate_id` INT NOT NULL,
                  `type` VARCHAR(45) NOT NULL,
                  `payment_date` DATE NOT NULL,
                  PRIMARY KEY (`id`),
                  CONSTRAINT `rate_id_rate_payments`
                    FOREIGN KEY (`rate_id`)
                    REFERENCES `rates` (`id`)
                    ON DELETE NO ACTION
                    ON UPDATE NO ACTION)";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table rate_payments";

        $this->execute($sql);
    }
}
