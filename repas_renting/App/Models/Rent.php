<?php
include_once(__DIR__ . "/Orm.php");
class Rent extends Orm
{

    public function __construct()
    {
        parent::__construct('rent');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `rent`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `id_scooter` INT NOT NULL,
            `user` INT NOT NULL,
            `price` FLOAT,
            `rent_start` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `rent_end` TIMESTAMP DEFAULT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }

    public function getByUser($user){
        $sql = "SELECT * FROM rent WHERE user = $user";
        $db = new Database();
        $result = $db->queryDataBase($sql)->fetch();

        if ($result) {
            return $result;
        } else{
            return null;
        }

    }
    public function getByUserArr($user){
        $sql = "SELECT * FROM rent WHERE user = :user";
        $params = [
            ":user" =>$user
        ];
        $db = new Database();
        $result = $db->queryDataBase($sql,$params)->fetchAll();

        if ($result) {
            return $result;
        } else{
            return null;
        }

    }
    public function updateRent($preuFinal, $dateAct, $id, $data){
        $dateActFormatted = $dateAct->format('Y-m-d H:i:s');
        $dataFormatted = $data->format('Y-m-d H:i:s');
        $sql = "UPDATE rent SET rent_end = '$dateActFormatted', price = $preuFinal WHERE id_scooter = $id AND rent_start = '$dataFormatted'";
        $db = new Database();
        $result = $db->queryDataBase($sql);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}
