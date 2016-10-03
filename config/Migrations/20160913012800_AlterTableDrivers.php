<?php
use Migrations\AbstractMigration;

class AlterTableDrivers extends AbstractMigration
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
MODIFY COLUMN `cpf`  varchar(14);";
        $this->execute($sql);

    }
}
