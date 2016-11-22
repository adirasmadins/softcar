<?php
use Migrations\AbstractMigration;

class AddColumnsDrivers extends AbstractMigration
{
    public function up(){
      $sql = "ALTER TABLE `drivers`
            	ADD COLUMN `number` INT NOT NULL AFTER `validity_cnh`,
            	ADD COLUMN `street` VARCHAR(255) NOT NULL AFTER `number`,
              ADD COLUMN `neighborhood` VARCHAR(255) NOT NULL AFTER `street`;
            ";
      $this->execute($sql);
    }
}
