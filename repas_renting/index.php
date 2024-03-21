<?php
include_once("App/config.php");
include_once("App/Router.php");
require_once(__DIR__ . "/App/config.php");
require_once(__DIR__ . "/App/Router.php");
require_once(__DIR__ . "/App/autoload.php"); //Canviar autolad de app que aquest linki el autoload de vendor

if (!isset($_SESSION)) {
    session_start();
}

// $userModel = new User();
// $adminUser = $userModel->getByUsername('admin');

// if (!$adminUser) {
//     $adminUserData = array(
//         "username" => "admin",
//         "name" => "UserAdmin",
//         "mail" => "admin@example.com",
//         "pass" => "1234",
//         "admin" => true,
//         "avisLegalDades" => true,
//         "avisEnviamentPropaganda" => false,
//         "profile_image" => "admin",
//         "verified" => true
//     );

//     $userModel->create($adminUserData);
// }

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$r = new Router();
$r->run();
// docker compose up -d
// attach shell al contenidor  i instal·lar composer
//composer install
?>
