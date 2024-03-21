<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Models/Curs.php");
include_once(__DIR__ . "/../Models/Uf.php");
include_once(__DIR__ . "/../Core/Controller.php");

class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS users,curs,ufs";
        $db->queryDataBase($sql);

        Users::createTable();
        Curs::createTable();
        Ufs::createTable();

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "1234";
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);

        $userModel = new Users();
        $user = [
            "username" => "ProfeMarc",
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

        $curs = [
            "name" => "MP06. Des. Entorn Client",
            "ufs" => "1,2,3,4",
            "curs_image" => "m6.png",
            "profe" => "ProfeMarc",
            "usuaris" => null,
            "description" => "Aquest curs és per a aprendre a desenvolupar aplicacions web amb tecnologies de client. Aprendràs a desenvolupar aplicacions web amb HTML, CSS i JavaScript, així com a utilitzar frameworks com Bootstrap i jQuery. També aprendràs a desenvolupar aplicacions web amb Angular i React.",
            "preu" => 0,
            "data_inici" => "2024-02-01",
            "data_final" => "2024-03-01"
          
        ];

        $cursModel = new Curs();
        $cursModel->insert($curs);

        $uf = [
            "name" => "Uf1. Desenvolupament web en entorn client",
            "curs_id" => 1,
            "ufs_images" => "uf1.png",
            "usuaris" => null,
            "contingut" => "Aquesta unitat formativa és per a aprendre a desenvolupar aplicacions web amb HTML, CSS i JavaScript, així com a utilitzar frameworks com Bootstrap i jQuery.",
            "data_inici" => "2024-02-01",
            "data_final" => "2024-03-01"
        ];

        $ufModel = new Ufs();
        $ufModel->insert($uf);

        //   INSERT INTO ufs (name, curs_id, ufs_images, contingut, data_inici, data_fi)
        // VALUES ('Uf1. Desenvolupament web en entorn client', 1, 'uf1.png', 'Aquesta unitat formativa és per a aprendre a desenvolupar aplicacions web amb HTML, CSS i JavaScript, així com a utilitzar frameworks com Bootstrap i jQuery.', '2024-02-01 00:00:00', '2024-03-01 00:00:00');
        // INSERT INTO curs (name, ufs, curs_image, profe, description, preu, data_inici, data_fi)
        // VALUES ('MP06. Des. Entorn Client', '1,2,3,4', 'm6.png', 'ProfeMarc', 'Aquest curs és per a aprendre a desenvolupar aplicacions web amb tecnologies de client. Aprendràs a desenvolupar aplicacions web amb HTML, CSS i JavaScript, així com a utilitzar frameworks com Bootstrap i jQuery. També aprendràs a desenvolupar aplicacions web amb Angular i React.', 0, '2024-02-01', '2024-03-01');
        
        // INSERT INTO curs (name, ufs, curs_image, profe, description, preu)
        // VALUES ('MP06. Des. Entorn Client', '1,2,3,4', 'm6.png', 'ProfeMarc', 'Aquest curs és per a aprendre a desenvolupar aplicacions web amb tecnologies de client. Aprendràs a desenvolupar aplicacions web amb HTML, CSS i JavaScript, així com a utilitzar frameworks com Bootstrap i jQuery. També aprendràs a desenvolupar aplicacions web amb Angular i React.', 0);
        header("Location: /main/index");
    }
}
