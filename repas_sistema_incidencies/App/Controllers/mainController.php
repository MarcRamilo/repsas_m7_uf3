<?php
include_once(__DIR__ . "/../Core/Controller.php");

class mainController extends Controller
{

    public function index()
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
        $params['title'] = 'Benvingut/da!';
        $this->render("home/index", $params, "site");
    }
}
?>
