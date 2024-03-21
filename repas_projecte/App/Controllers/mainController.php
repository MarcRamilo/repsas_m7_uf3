<?php
include_once(__DIR__ . "/../Core/Controller.php");

class mainController extends Controller
{

    public function index()
    {
        $params['title'] = 'Benvingut/da!';
        $this->render("home/index", $params, "site");
    }
}
?>
