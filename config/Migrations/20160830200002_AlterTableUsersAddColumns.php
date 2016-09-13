<?php
use Migrations\AbstractMigration;

class AlterTableUsersAddColumns extends AbstractMigration
{
    public function up(){
        $sql = "
                ALTER TABLE users add column email varchar(255);
                ALTER TABLE users add column token varchar(255);
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "ALTER TABLE users drop column email;
                ALTER TABLE users drop column token;";

        $this->execute($sql);
    }
}
