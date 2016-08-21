<?php
use Migrations\AbstractMigration;

class CreateUsersInBase extends AbstractMigration
{

    public function up()
    {
        $sql = "
                INSERT INTO `profiles` VALUES (null, 'Desenvolvedor');
                INSERT INTO `users` VALUES (null, 'Programador', 'm', '1995-10-10', 978847199, 129338229, 'Rua Admin', 123, 'Admin', '4335347149', '4396499498', 1, '86430-000',4704, 18, 'admin', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 1);";

        $this->execute($sql);
    }
}
