<?php
use Migrations\AbstractMigration;

class CreateModuleTypes extends AbstractMigration
{
    public function up(){
        $sql = "INSERT INTO Menus (id, text, controller, action, icon, route, parent_id, type) values
                              (null, 'Tipos de Veículos','Types','index', null, 'types', 2,'default');

                INSERT INTO types (id, name) values (null, 'Carro Comum');
                INSERT INTO types (id, name) values (null, 'Caminhonete');
                INSERT INTO types (id, name) values (null, 'Utilitário');
                INSERT INTO types (id, name) values (null, 'Cargueiro');
                INSERT INTO types (id, name) values (null, 'Carro de Luxo');
                              ";
        $this->execute($sql);
    }

    public function down(){
        $sql = "
                delete from types
                delete from menus where controller = 'Types';";

        $this->execute($sql);
    }
}
