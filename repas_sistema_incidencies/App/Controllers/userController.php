<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Store.php");
include_once(__DIR__ . "/../Models/Ticket.php");
include_once(__DIR__ . "/../Models/Device.php");

class userController extends Controller
{
    public function login()
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

        $this->render("user/login", $params, "site");
    }
    public function checkLogin()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $userModel = new Users();
        $validate = $userModel->checkLogin($username, $password);

        if ($validate != null) {
            $_SESSION['flash']['ok'] = "Usuari creat correctament!";
            $_SESSION['logged_user'] = $validate;
            header("Location: /main/index");
            return;
        } else {
            $_SESSION['flash']['ko'] = "Usuari o contrassenya incorrecta!";
            header("Location: /user/login");
            return;
        }
    }
    public function logout()
    {
        unset($_SESSION['logged_user']);
        header("Location: /main/index");
    }
    public function home()
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

        $this->render("/home/index", $params, "site");
    }
    public function singup()
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

        $this->render("user/singup", $params, "site");
    }
    public function store()
    {
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $admin = isset($_POST['admin']) ? 1 : 0;

        $origen = $_FILES['profile_image']['tmp_name'];
        $desti = "images/profile_images";
        $array = explode(".", $_FILES['profile_image']['name']);
        $extensio = end($array);
        $dataAcutal = date('Y_m_d_H_m_s');
        $nomFitxer = $username . "_" . $dataAcutal . "." . $extensio;

        if ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash']['ko'] = "Err1_No s'ha pogut carregar l'imatge";
            header("Location: /user/singup");
            return;
        }

        $result = Store::store($origen, $desti, $nomFitxer);

        if (!$result) {
            $_SESSION['flash']['ko'] = "Err2_No s'ha pogut carregar l'imatge";
            header("Location: /user/singup");
            return;
        }

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passwordTotal = $pepper . $password . $salt;
        $passToHash = password_hash($passwordTotal, PASSWORD_ARGON2ID);

        $user = [
            "username" => $username,
            "mail" => $mail,
            "password" => $passToHash,
            "profile_image" => $nomFitxer,
            "admin" => $admin,
            "salt" => $salt
        ];

        $userModel = new Users();

        $result = $userModel->insert($user);

        if (!$result) {
            $_SESSION['flash']['ko'] = "No s'ha pogut guardar el usuari a la BBDD";
            header("Location: /user/singup");
            return;
        } else {
            $_SESSION['flash']['ok'] = "Usuari creat correctament!";
            header("Location: /user/login");
            return;
        }
    }
    public function profile()
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

        $devicesModel = new Device();
        // Asegúrate de que getByUserArr() devuelva un array
        $devices = $devicesModel->getByUserArr($_SESSION['logged_user']['id']);
       
        // Verifica si $rentData es un array antes de asignarlo a $params['rent']
        if (!is_array($devices)) {
            $params['devices'] = array($devices);
        } else {
            // Si getByUserArr() no devuelve un array, puedes asignar un array vacío o manejar el error de alguna otra manera
            $params['devices'] = $devices;
        }

        $params['user'] = $_SESSION['logged_user'];
        $this->render("user/profile", $params, "site");
    }
}
