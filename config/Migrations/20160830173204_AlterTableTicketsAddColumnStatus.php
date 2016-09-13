<?php
use Migrations\AbstractMigration;

class AlterTableTicketsAddColumnStatus extends AbstractMigration
{

    public function up()
    {
        $sql = "
                ALTER TABLE tickets add column status int";

        $this->execute($sql);
    }
}
