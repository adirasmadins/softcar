<?php
use Migrations\AbstractMigration;

class PopulateTableProfiles extends AbstractMigration
{

    public function up()
    {
        $sql = "
                INSERT INTO `profiles` VALUES (null, 'Gerente');
                INSERT INTO `profiles` VALUES (null, 'Funcionário');";

        $this->execute($sql);
    }
}
