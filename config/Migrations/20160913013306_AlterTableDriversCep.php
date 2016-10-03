<?php
use Migrations\AbstractMigration;

class AlterTableDriversCep extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
         public function up(){
         $sql="ALTER TABLE `drivers`
MODIFY COLUMN `cep`  varchar(9);";
         $this->execute($sql);

     }
}
