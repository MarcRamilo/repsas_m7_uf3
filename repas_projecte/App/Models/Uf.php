<?php
include_once(__DIR__ . "/Orm.php");
class Ufs extends Orm
{

    public function __construct()
    {
        parent::__construct('ufs');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `ufs`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `curs_id` INT NOT NULL,
            `name` VARCHAR(100) NOT NULL,
            `ufs_images` VARCHAR(100) NOT NULL,
            `usuaris` VARCHAR(1000),
            `contingut` VARCHAR(1000) NOT NULL,
            `data_inici` DATE NOT NULL,
            `data_final` DATE NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP   
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function assign($uf,$curs){
        $sql = "UPDATE ufs SET curs_id = :curs_id WHERE id = :id";
        $params = [
            ":curs_id" => $curs,
            ":id" => $uf
        ];
        $db = new Database();
        $result = $db->queryDataBase($sql,$params);
        return $result;
    }
}
