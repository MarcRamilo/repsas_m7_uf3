<?php
include_once(__DIR__ . "/Orm.php");
class Types extends Orm
{

    public function __construct()
    {
        parent::__construct('types');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `types`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `type` VARCHAR(100) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function getName($id)
    {
   
        $sql = "SELECT * FROM types WHERE id = :id";
        $params = [
            ":id" => $id
        ];
        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();
        if ($result) {
            return $result;
        } else{
            return null;
        }
    }
}
