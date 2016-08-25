<?php
use Migrations\AbstractMigration;

class PopulateTableFuels extends AbstractMigration
{
    public function up(){
        $sql = "
                INSERT INTO fuels (id, name) VALUES (null, 'Etanol');
                INSERT INTO fuels (id, name) VALUES (null, 'Gasolina');
                INSERT INTO fuels (id, name) VALUES (null, 'Diesel');
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "DELETE FROM fuels";

        $this->execute($sql);
    }
}
