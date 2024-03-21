<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Store.php");

class userController extends Controller
{
    public function login()
    {
        $params['flash'] = [];
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])){
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])){
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if(isset($_SESSION['logged_user'])){
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $params['title'] = "Benvingut/da!";
        $this->render("user/login", $params, "site");
    }

    public function checkLogin(){
        
        $userModel = new Users();
        $user = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($user) && !empty($password)) {
           $result = $userModel->login($user,$password);
        } else{
            $_SESSION['flash']['ko'] = "Insereix totes les dades!";
        }

        if ($result == null || !$result ) {
            $_SESSION['flash']['ko'] = "Usuari o contrasenya incorrectes";
            header("Location: /user/login");
        } else{
            $_SESSION['logged_user'] = $result;
            header('Location: /main/index');
        }
    }
    public function logout(){
        unset($_SESSION['logged_user']);
        header('Location: /main/index');
    }

    public function singup(){
        $params['flash'] = [];
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])){
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])){
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if(isset($_SESSION['logged_user'])){
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $params['title'] = "Benvingut/da!";
        $this->render("user/singup", $params, "site");
    }

    public function store(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $mail = $_POST['mail'];
        $admin = isset($_POST['admin']) ? 1 : 0;
        $origen = $_FILES['profile_image']['tmp_name'];
        $desti = "images/profile_images/";
        
        $array = explode("." , $_FILES['profile_image']['name']);
        $extensio = $array[count($array) - 1];
        $nomFitxer = $username . "." . $extensio;

        if($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK){
            $_SESSION['flash']['ko']  = "Error al pujar l'imatge";
            header("Location: /user/singup");
            return;
        }

        $storeResult = Store::store($origen,$desti,$nomFitxer);
        if ($storeResult !== true) {
            $_SESSION['flash']['ko'] = "Error al pujar l'imatge. Recorda :Nomès s'accepten imatges en format jpg.";
            header("Location: /user/singup");
            return;
        }

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passPS = $pepper . $password . $salt;
        $passHashed = password_hash($passPS, PASSWORD_ARGON2ID);

        $user = [
            "username" => $username,
            "mail" => $mail,
            "password" => $passHashed,
            "profile_image" => $nomFitxer,
            "admin" => $admin,
            "salt" => $salt
        ];

        $userModel = new Users;

        $result = $userModel->insert($user);

        if($result != null){
            $_SESSION['flash']['ok'] = "Usuari creat correctament!";
            header("Location: /user/login");
        } else{
            $_SESSION['flash']['ko'] = "Error al guardar l'usuari!";

        }


        
    }

    public function home(){
        $params['flash'] = [];
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])){
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])){
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if(isset($_SESSION['logged_user'])){
            $params['logged_user'] = $_SESSION['logged_user'];
        }
        $params['title'] = "Benvingut/da!";
        $this->render("home/index", $params, "site");
    }

    public function admin(){
        $params['flash'] = [];
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ko'])){
            $params['flash']['ko'] = $_SESSION['flash']['ko'];
            unset($_SESSION['flash']['ko']);
        }
        if(isset($_SESSION['flash']) && isset($_SESSION['flash']['ok'])){
            $params['flash']['ok'] = $_SESSION['flash']['ok'];
            unset($_SESSION['flash']['ok']);
        }
        if(isset($_SESSION['logged_user'])){
            $params['user'] = $_SESSION['logged_user'];
        }
        $params['title'] = "Benvingut/da!";
        $this->render("admin/index", $params, "site");
    }
}