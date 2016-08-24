<?php
use Migrations\AbstractMigration;

class CreateTableProfileMenus extends AbstractMigration
{
    public function up(){
        $sql = "CREATE TABLE profile_menus (
                id int NOT NULL AUTO_INCREMENT ,
                profile_id int NOT NULL,
                menu_id int NOT NULL,
                PRIMARY KEY (id),
                CONSTRAINT profile_id_profiles FOREIGN KEY (profile_id) REFERENCES profiles (id),
                CONSTRAINT menu_id_menus FOREIGN KEY (menu_id) REFERENCES menus (id));

                INSERT INTO profile_menus (id, profile_id, menu_id) values (null, 1, 1);
                INSERT INTO profile_menus (id, profile_id, menu_id) values (null, 1, 3);
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "drop table profile_menus;";

        $this->execute($sql);
    }
}
