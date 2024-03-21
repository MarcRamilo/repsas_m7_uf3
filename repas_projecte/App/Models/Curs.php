<?php
include_once(__DIR__ . "/Orm.php");
class Curs extends Orm
{

    public function __construct()
    {
        parent::__construct('curs');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `curs`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(100) NOT NULL,
            `ufs` VARCHAR(100) NOT NULL,
            `curs_image` VARCHAR(100) NOT NULL,
            `profe` VARCHAR(100) NOT NULL,
            `usuaris` VARCHAR(200),
            `description` VARCHAR(1000) NOT NULL,
            `preu` INT NOT NULL,
            `data_inici` DATE NOT NULL,
            `data_final` DATE NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
}
