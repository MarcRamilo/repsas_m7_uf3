<?php
include_once(__DIR__ . "/../Models/Scooter.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Core/Store.php");
class scooterController extends Controller
{

    public function list()
    {
        $params['flash'] = [];
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])) {
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);

        }
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])) {
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);

        }
        if (isset($_SESSION['logged_user'])) {
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $scooterModel = new Scooter();
        $params['scooters'] = $scooterModel->getAll();
        $this->render("scooter/list", $params, "site");
    }
}
