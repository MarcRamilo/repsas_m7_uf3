<?php
include_once(__DIR__ . "/../Models/Curs.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Core/Store.php");
class cursController extends Controller
{
    public function list()
    {
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
        $cursModel = new Curs();
        $usersModel = new Users;
        $params['profesors'] = $usersModel->getByAdmin();
        $params['cursos'] = $cursModel->getAll();
        $this->render("curs/list", $params, "site");
    }

    public function show()
    {

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
        $cursModel = new Curs();
        $id = $_GET['id'];
        $params['curs'] = $cursModel->getById($id);
        $this->render("curs/show", $params, "site");
    }

    public function create()
    {
        $params['flash'] = [];
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])) {
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
        }
        if (isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])) {
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
        }
        if (isset($_SESSION['logged_user'])) {
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $usersModel = new Users;
        $result = $usersModel->getByAdmin();
        if (!$result) {
            $_SESSION['flash']['ko'] = "Error al agafar  els ususaris";
        } else {
            $params['profesors'] = $result;
            $params['title'] = "Crea nou curs";
            $this->render("curs/create", $params, "site");
        }
    }
    public function store()
    {
        $name = $_POST['name'];
        $ufs = $_POST['ufs'];
        $user = $_POST['profe'];
 
        $usersModel = new Users;
        $profe = $usersModel->getById($user);
 
        $usuaris = null;
        $description = $_POST['description'];
        $preu = $_POST['preu'];
        $data_inici = $_POST['data_inici'];
        $data_final = $_POST['data_final'];
    
        $origen = $_FILES['curs_image']['tmp_name'];
        $desti = "images/cursos_images";
        $array = explode(".", $_FILES['curs_image']['name']);
        $extensio = strtolower(end($array)); // Obtener la extensión del archivo en minúsculas
        
        $nomFitxer = $name . "." . $extensio;
        
        if ($_FILES['curs_image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash']['ko'] = "Error al pujar l'imatge: " . $_FILES['curs_image']['error'];
            header("Location: /curs/create");
            exit;
        }
        
        // Verificar si la extensión es permitida (puedes añadir más extensiones si es necesario)
        $extensiones_permitidas = array('jpg', 'jpeg', 'png');
        if (!in_array($extensio, $extensiones_permitidas)) {
            $_SESSION['flash']['ko'] = "El formato de archivo no es válido. Solo se permiten archivos JPG, JPEG y PNG.";
            header("Location: /curs/create");
            exit;
        }
        
        $storeResult = Store::store($origen, $desti, $nomFitxer);
        
        if ($storeResult !== true) {
            $_SESSION['flash']['ko'] = "Error al pujar l'imatge.";
            header("Location: /curs/create");
            exit;
        }


        $curs = [
            "name" => $name,
            "ufs" => $ufs,
            "curs_image" => $nomFitxer,
            "profe" => $profe['username'],
            "usuaris" => $usuaris,
            "description" => $description,
            "preu" => $preu,
            "data_inici" => $data_inici,
            "data_final" => $data_final
        ];
        $cursModel = new Curs();
        $result = $cursModel->insert($curs);
        if ($result != null) {
            $_SESSION['flash']['ok'] = "Curs creat correctament";
            header("Location: /curs/list");
        } else {
            $_SESSION['flash']['ko'] = "Error al crear el curs";
            header("Location: /curs/create");
        }
    }
}
