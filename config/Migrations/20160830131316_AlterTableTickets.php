<?php
use Migrations\AbstractMigration;

class AlterTableTickets extends AbstractMigration
{

    public function up()
    {
        $sql = "
                ALTER TABLE tickets drop column value;
                ALTER TABLE tickets modify column client_id int null;
                ALTER TABLE tickets add column value varchar(20);
                ALTER TABLE tickets drop column client_not_registered;
                ALTER TABLE tickets add column name_not_registered varchar(255);
                ALTER TABLE tickets add column rg_not_registered varchar(45);
                ALTER TABLE tickets add column cpf_not_registered varchar(45);";

        $this->execute($sql);
    }
}
