<?php
use Migrations\AbstractMigration;

class CreateColumnsInRates extends AbstractMigration
{
    public function up(){
        $sql = "
                ALTER TABLE rates add column ipva_status INT;
                ALTER TABLE rates add column depvat_status INT;
                ALTER TABLE rates add column licensing_status INT;
                ";

        $this->execute($sql);
    }

    public function down(){
        $sql = "ALTER TABLE rates drop column ipva_status;
                ALTER TABLE rates drop column depvat_status;
                ALTER TABLE rates drop column licensing_status;";

        $this->execute($sql);
    }
}
