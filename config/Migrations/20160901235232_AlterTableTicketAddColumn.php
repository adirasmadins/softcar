<?php
use Migrations\AbstractMigration;

class AlterTableTicketAddColumn extends AbstractMigration
{
    public function up(){
        $sql = "ALTER TABLE tickets add column ticket_date date";
        $this->execute($sql);
    }

    public function down(){
        $sql = "ALTER TABLE tickets drop column ticket_date";

        $this->execute($sql);
    }
}
