<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Models/Scooter.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Rent.php");
class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS users,scooter,rent";
        $db->queryDataBase($sql);

        Users::createTable();
        Scooter::createTable();

        Rent::createTable();    
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

        session_destroy();
        session_start();

        $scooterModel = new Scooter();
        $scooter = [
            'model' => 'Achilleus EY4',
            'img' => 'p1.jpg',
            'price' => 0.45,
            'user_rent' => null,

        ];
        
        $scooterModel->insert($scooter);

        $scooter = [
            'model' => 'City',
            'img' => 'p2.jpeg',
            'price' => 0.48,
            'user_rent' => null,

        ];

        $scooterModel->insert($scooter);

        $scooter = [
            'model' => 'Spider',
            'img' => 'p3.jpeg',
            'price' => 0.50,
            'user_rent' => null,

        ];

        $scooterModel->insert($scooter);

        $scooter = [
            'model' => 'M365',
            'img' => 'p4.jpeg',
            'price' => 0.35,
            'user_rent' => null,

        ];

        $scooterModel->insert($scooter);

        $scooter = [
            'model' => 'M365 Pro',
            'img' => 'p5.jpeg',
            'price' => 0.40,
            'user_rent' => null,

        ];
        $scooterModel->insert($scooter);

        header("Location: /main/index");
    }
}
