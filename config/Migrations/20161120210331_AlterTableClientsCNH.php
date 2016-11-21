<?php
use Migrations\AbstractMigration;

class AlterTableClientsCNH extends AbstractMigration
{
    public function up (){
      $sql = "ALTER TABLE `clients`
              	ALTER `cnh` DROP DEFAULT;
              ALTER TABLE `clients`
              	CHANGE COLUMN `cnh` `cnh` DOUBLE NOT NULL AFTER `cep`;
              ";
      $this->execute($sql);        
    }
}
