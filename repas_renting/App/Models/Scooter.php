<?php
include_once(__DIR__ . "/Orm.php");
class Scooter extends Orm
{

    public function __construct()
    {
        parent::__construct('scooter');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `scooter`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `model` VARCHAR(100) NOT NULL,
            `img` VARCHAR(100) NOT NULL,
            `price` FLOAT NOT NULL,
            `user_rent` INT ,
            `rent_start` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function updateUser($id, $userId)
    {
        $sql = "UPDATE scooter SET user_rent = ? WHERE id = ?";
        $db = new Database();
        $result = $db->queryDataBase($sql, [$userId, $id]);
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getByUser($user)
    {
        $sql = "SELECT * FROM scooter WHERE user_rent = $user";
        $db = new Database();
        $result = $db->queryDataBase($sql)->fetch();
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }
}
