<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Users.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Store.php");
include_once(__DIR__ . "/../Models/Ticket.php");
include_once(__DIR__ . "/../Models/Device.php");
include_once(__DIR__ . "/../Models/Types.php");

class ticketController extends Controller
{

    public function incidence()
    {
        $params['flash'] = [];
        $id = $_GET['id'];
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
        $device = $devicesModel->getById($id);
        $params['device'] = $device;
        $params['user'] = $_SESSION['logged_user'];
        $typesModel = new Types();
        $this->render("ticket/create", $params, "site");
    }

    public function store()
    {
        $user = $_POST['user'];
        $device = $_POST['device'];
        $prioritat = $_POST['prioritat'];
        $decription = $_POST['decription'];
        
        if ($_SESSION['logged_user']['admin'] == 0) {
            $nivell = 0;
        } else{
            $nivell = 1;
        }
        $data = new DateTime();
        $ticket = [
            "user" => $user,
            "device" => $device,
            "estat" => "PENDENT",
            "prioritat" => $prioritat,
            "description" => $decription,
            "solucio" => null,
            "nivell" => $nivell,
            "ticket_opened" =>$data->format('Y-m-d H:i:s'),
            "ticket_closed" => null
        ];

        $ticketModel = new Ticket();
        $result = $ticketModel->insert($ticket);

        if ($result) {
            $_SESSION['flash']['ok'] = "Incidencia creada correctament!";
            header("Location: /main/index");
            return;
        } else {
            $_SESSION['flash']['ko'] = "Error al crear la incidencia!";
            header("Location: /ticket/incidence/?id=$device");
            return;
        }
    }

    public function delete(){
        $id = $_GET['id'];
        $ticketModel = new Ticket();
        $ticketToDelete = $ticketModel->getById($id);
        $result = $ticketModel->removeItemById($ticketToDelete['id']);
        
        if ($result) {
            $_SESSION['flash']['ok'] = "Ticket Eliminat correctament!";
            header('Location: /devices/list');
            return;
        } else{
            $_SESSION['flash']['ko'] = "Ticket no eliminat!";
            header('Location: /devices/list');
            return;
        }

    }

    public function escalar(){
        $id = $_GET['id'];
        $ticketModel = new Ticket();
        $ticketToEsclar= $ticketModel->getById($id);
        $result = $ticketModel->updateTicketLevelById($ticketToEsclar['id'],$ticketToEsclar['nivell']);
        if ($result) {
            $_SESSION['flash']['ok'] = "Ticket Escalat correctament!";
            header('Location: /devices/list');
            return;
        } else{
            $_SESSION['flash']['ko'] = "Ticket no escalat!";
            header('Location: /devices/list');
            return;
        }

    }

    public function solve(){
        $id = $_GET['id'];
        $ticketModel = new Ticket();
        $ticketToSolve= $ticketModel->getById($id);
        $params['ticket'] = $ticketToSolve;
        $params['flash'] = [];
        $id = $_GET['id'];
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
        $this->render("ticket/solve",$params,"site");
    }

    public function solved(){
        $id = $_POST['id'];
        $ticketModel = new Ticket();
        $solution = $_POST['solution'];
        $dateClosed = new DateTime();
        $ticket = $ticketModel->getById($id);
        $result =$ticketModel->solveit($ticket,$solution,$dateClosed);
        if ($result) {
            $_SESSION['flash']['ok'] = "Ticket solucionat correctament!";
            header('Location: /devices/list');
            return;
        } else{
            $_SESSION['flash']['ko'] = "Ticket no solucionat!";
            header('Location: /devices/list');
            return;
        }
    }
}
