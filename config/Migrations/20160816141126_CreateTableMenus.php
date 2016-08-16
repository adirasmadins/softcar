<?php
use Migrations\AbstractMigration;

class CreateTableMenus extends AbstractMigration
{
    public function up(){
        $sql = "CREATE TABLE menus (
                id int NOT NULL AUTO_INCREMENT ,
                text VARCHAR (100) not null,
                controller varchar(100),
                action varchar(100),
                icon VARCHAR (100) null,
                route VARCHAR (100) null,
                parent_id int null,
                type  VARCHAR (100) null,
                PRIMARY KEY (id))";
        $this->execute($sql);
    }

    public function down(){
        $sql = "DROP TABLE menus";

        $this->execute($sql);
    }
}
