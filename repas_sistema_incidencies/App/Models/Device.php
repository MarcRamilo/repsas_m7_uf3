<?php
include_once(__DIR__ . "/Orm.php");
class Device extends Orm
{

    public function __construct()
    {
        parent::__construct('device');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `device`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `model` VARCHAR(100) NOT NULL,
            `img` VARCHAR(100) NOT NULL,
            `user` INT ,
            `type` INT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function getByUserArr($id){
        $sql = "SELECT * FROM device WHERE user = :user";
        $params =[
            ":user" => $id
        ];
        $db = new Database();
        $result= $db->queryDataBase($sql,$params)->fetchAll();

        if ($result) {
            return $result;
        } else{
            return null;
        }
    }
  
    public function getLastId(){
        $sql = "SELECT * from device";
        $db = new Database();
        $result = $db->queryDataBase($sql)->fetchAll();

        if ($result) {
            $countItems = count($result);
            return $countItems;
        } else{
            return null;
        }
        
    }
}
