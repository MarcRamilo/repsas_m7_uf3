<?php
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Device.php");
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Models/Types.php");
include_once(__DIR__ . "/../Models/Ticket.php");
include_once(__DIR__ . "/../Core/Store.php");;
class devicesController extends Controller
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

        if (!isset($_SESSION['logged_user'])) {
            header('Location: /user/login');
            return;
        } else{
            $params['logged_user'] = $_SESSION['logged_user'];

        }
        $devicesModel = new Device();
        $params['devices'] = $devicesModel->getAll();
        $level = $_SESSION['logged_user']['admin'];
        $ticketModel = new Ticket();
        $tickets = $ticketModel->getLevelTicekt($level);
        $params['ticket'] = $tickets;
        $this->render("devices/list", $params, "site");
    }

    public function create()
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
        $userModel = new Users();
        $users = $userModel->getAll();
        $params['users'] = $users;
        $typesModel = new Types();
        $types = $typesModel->getAll();
        $params['types'] = $types;

        $this->render("devices/create", $params, "site");
    }

    public function store()
    {
        $model = $_POST['model'];

        $origin = $_FILES['image']['tmp_name'];
        $desti = "images/rent";
        $array = explode(".", $_FILES['image']['name']);
        $extensio = $array[count($array) - 1];
        $devicesModel = new Device();
        $lastId = $devicesModel->getLastId();
        $lastId++;
        $nomFitxer = $model . "" . $lastId . "." . $extensio;


        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash']['ko'] = "Err1. Error al carregar l'imatge";
            header("Location: /devices/create");
            return;
        }

        $result = Store::store($origin, $desti, $nomFitxer);

        if (!$result) {
            $_SESSION['flash']['ko'] = "Err1. Error al carregar l'imatge";
            header("Location: /devices/create");
            return;
        }


        $user = $_POST['user'];
        $type = $_POST['type'];

        $device = [
            "model" => $model,
            "img" => $nomFitxer,
            "user" => $user,
            "type" => $type
        ];

        $result = $devicesModel->insert($device);

        if ($result) {
            $_SESSION['flash']['ok'] = "Device registrat correctament!";
            header("Location: /main/index");
            return;
        } else {
            $_SESSION['flash']['ko'] = "Error al registrar el device!";
            header("Location: /devices/create");
            return;
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $devicesModel = new Device();
        $result = $devicesModel->removeItemById($id);
        if ($result) {
            $_SESSION['flash']['ok'] = "Device eliminat correctament!";
            header("Location: /devices/list");
            return;
        } else {
            $_SESSION['flash']['ko'] = "Error al eliminar el device";
            header("Location: /devices/list");
            return;
        }
    }
}
