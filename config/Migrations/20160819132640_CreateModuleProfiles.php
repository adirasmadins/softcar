<?php
use Migrations\AbstractMigration;

class CreateModuleProfiles extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Configurações', null,null,'gear', null, null, 'parent');
                INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Perfis','Profiles','index', null, 'profiles', 2,'default');";
        $this->execute($sql);
    }

    public function down(){
        $sql = "delete from menus where controller = 'Profiles';";

        $this->execute($sql);
    }
}
