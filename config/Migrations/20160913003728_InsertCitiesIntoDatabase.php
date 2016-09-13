<?php
use Migrations\AbstractMigration;

class InsertCitiesIntoDatabase extends AbstractMigration
{
    public function up(){
        $sql="INSERT INTO cities (id, name, state_id) VALUES (NULL, 'Pescaria Brava', 24);
              INSERT INTO cities (id, name, state_id) VALUES (NULL, 'Balneário Rincão', 24);
              INSERT INTO cities (id, name, state_id) VALUES (NULL, 'Mojuí dos Campos', 14);
              INSERT INTO cities (id, name, state_id) VALUES (NULL, 'Pinto Bandeira', 23);
              INSERT INTO cities (id, name, state_id) VALUES (NULL, 'Paraíso das Águas', 12);
              ";
        $this->execute($sql);

    }
}
