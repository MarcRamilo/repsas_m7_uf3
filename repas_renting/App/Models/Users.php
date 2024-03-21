<?php
include_once(__DIR__ . "/Orm.php");
class Users extends Orm
{

    public function __construct()
    {
        parent::__construct('users');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `users`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(100) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `password` VARCHAR(100) NOT NULL,
            `profile_image` VARCHAR(100) NOT NULL,
            `admin` BOOLEAN NOT NULL DEFAULT 0,
            `salt` VARCHAR(100) NOT NULL
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function checkLogin($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $db = new Database();
        $params = [
            ":username" => $username
        ];
        $result = $db->queryDataBase($sql, $params)->fetch();

        if (!$result) {
            return null;
        } else {
            $pepper = $_ENV['PEPPER'];
            $salt = $result['salt'];
            $passtoCheck = $pepper . $password . $salt;

            if (password_verify($passtoCheck, $result['password'])) {
                return $result;
            } else {
                return null;
            }
        }
    }
    public function getByAdmin()
    {
        $sql = "SELECT * FROM users WHERE admin = 1";
        $params = null;
        $db = new Database;
        $result = $db->queryDataBase($sql, $params)->fetchAll();

        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
}
