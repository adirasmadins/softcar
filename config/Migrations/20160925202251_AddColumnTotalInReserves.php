<?php
use Migrations\AbstractMigration;

class AddColumnTotalInReserves extends AbstractMigration
{
    public function up()
    {
        $sql = "ALTER TABLE reserves ADD COLUMN total VARCHAR(25);";

        $this->execute($sql);
    }
}
