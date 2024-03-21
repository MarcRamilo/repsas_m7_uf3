<?php
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Uf.php");
include_once(__DIR__ . "/../Models/Curs.php");
class ufsController extends Controller
{

    public function list(){
        
        $params['flash'] = [];
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])) {
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])) {
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if (isset($_SESSION['logged_user'])) {
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $params['title'] = "Benvingut/da!";
        $ufsModel = new Ufs();
        $cursModel = new Curs();
        $params['cursos'] = $cursModel->getAll();
        $params['ufs'] = $ufsModel->getAll();
        $this->render("ufs/list", $params, "site");
    }
    public function assign(){
        $ufsModel = new Ufs();
        $cursModel = new Curs();
        $uf = $_POST['uf']; 
        $ufInt = (int)$uf;
        echo '<pre>';
        var_dump($ufInt);
        echo '</pre>';
        $curs = $cursModel->getById($ufInt);
        echo '<pre>';
        var_dump($curs);
        echo '</pre>';
        die();
        // $ufsModel->assign($uf); 
        header('Location: /ufs/list');
    }
}
?>
