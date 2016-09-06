<?php
use Migrations\AbstractMigration;

class AlterTableClients extends AbstractMigration
{
   public function up(){
       $sql="ALTER TABLE clients DROP COLUMN cpf_cnpj;
             ALTER TABLE clients ADD COLUMN cpf_cnpj VARCHAR(45)";
       $this->execute($sql);


   }
}
