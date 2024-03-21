<?php
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Scooter.php");
include_once(__DIR__ . "/../Models/Rent.php");
class rentController extends Controller
{

    public function renting()
    {
        $id = $_GET['id'];
        $scooterModel = new Scooter();
        $scooter = $scooterModel->getById($id);
        $rentModel = new Rent();

        $rent = [
            "id_scooter" => $id,
            "user" => $_SESSION['logged_user']['id'],
            "price" => $scooter['price'],
            "rent_start" => date("Y-m-d H:m:s"),
            "rent_end" => null
        ];

        $result = $rentModel->insert($rent);
        $updated = $scooterModel->updateUser($id, $rent['user']);

        if ($result && $updated) {
            $_SESSION['flash']['ok'] = "Patinet reservat. Model: " . $scooter['model'] . " .Per la data: " . $rent['rent_start'] . " .Per usuari: " . $_SESSION['logged_user']['username'];
            header("Location: /scooter/list");
            return;
        } else {
            $_SESSION['flash']['ko'] = "Error al guardar la reserva";
            header("Location: /scooter/list");
            return;
        }
    }
    public function returning()
    {
        $id = $_GET['id'];
        $scooterModel = new Scooter();
        $id_user = $_SESSION['logged_user']['id'];
        $scooter = $scooterModel->getByUser($id_user);
        $user = $scooter['user_rent'];
        $rentModel = new Rent();
        $rent = $rentModel->getByUser($user);
        $dataActual = date("Y-m-d H:i:s"); 
        $dateAct = new DateTime($dataActual);
        $dataAnterior = new DateTime($rent['rent_start']);
        $tempsTotal = $dateAct->diff($dataAnterior);
        $minutesTotal = $tempsTotal->days * 24 * 60 + $tempsTotal->h * 60 + $tempsTotal->i;
        $preuFinal = $minutesTotal * $scooter['price']; 

        $result = $rentModel->updateRent($preuFinal, $dateAct, $id,$dataAnterior);

        if ($result) {
            $_SESSION['flash']['ok'] = "Reserva finalitzada";
        } else {
            $_SESSION['flash']['ok'] = "No s'ha pogut finalitzar la reserva";
        }
        $userScooter = null;
        $scooterModel->updateUser($id,$userScooter);
        unset($dataActual);
        unset($dataActual);
        header("Location: /scooter/list");
        return;
    }
}
