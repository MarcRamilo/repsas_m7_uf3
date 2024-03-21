<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Models/Device.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Ticket.php");
include_once(__DIR__ . "/../Models/Types.php");

class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS users,device,ticket,types";
        $db->queryDataBase($sql);

        Users::createTable();
        Device::createTable();
        Ticket::createTable();    
        Types::createTable();

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "1234";
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);

        $userModel = new Users();
        $user = [
            "username" => "admin",
            "mail" => "mardead5@gmail.com",
            "password" => $passHashed,
            "profile_image" => "admin.jpg",
            "admin" => 1,
            "salt" => $salt
        ];

        $userModel->insert($user);

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "1234";
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);
        $user = [
            "username" => "marcrami",
            "mail" => "marcramilogarrido04@gmail.com",
            "password" => $passHashed,
            "profile_image" => "marcrami.jpg",
            "admin" => 0,
            "salt" => $salt
        ];

        $userModel->insert($user);
        $deviceModel = new Device();

        $device = [
            "model" => "Xiaomi M365",
            "img" => "p1.jpg",
            "user" => 2,
            "type" => 1
        ];
        $deviceModel->insert($device);

        $device = [
            "model" => "Ninebot ES2",
            "img" => "p2.jpg",
            "user" => 1,
            "type" => 2
        ];
        $deviceModel->insert($device);

        $typeModel = new Types();
        $type = [
            "type" => "PHONES"
        ];
        $typeModel->insert($type);

        $type = [
            "type" => "SCOOTERS"
        ];

        $typeModel->insert($type);


        header("Location: /main/index");
    }
}
