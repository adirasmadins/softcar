<?php
use Migrations\AbstractMigration;

class Contract extends AbstractMigration
{
    public function up(){
        $sql = "
            CREATE TABLE contract (
            id int NOT NULL AUTO_INCREMENT,
            text text NOT NULL,
            update_at date NOT NULL,
            PRIMARY KEY(id));
        ";
        $this->execute($sql);
    }
}
