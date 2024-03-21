<?php
include_once(__DIR__ . "/Orm.php");
class Ticket extends Orm
{

    public function __construct()
    {
        parent::__construct('ticket');
    }
    public static function createTable()
    {
        $sql = "CREATE TABLE `pr`. `ticket`(
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user` INT,
            `device` INT NOT NULL,
            `estat`  varchar(100) NOT NULL,
            `prioritat` varchar(100) NOT NULL,
            `description` varchar(100) NOT NULL,
            `solucio` varchar(100),
            `nivell` int not null ,
            `ticket_opened` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `ticket_closed` TIMESTAMP DEFAULT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP    
        ) ";
        $db =  new Database();
        $db->queryDataBase($sql);
    }
    public function getLevelTicekt($nivell)
    {
        $sql = "SELECT * FROM ticket WHERE nivell = :nivell";
        $params = [
            ":nivell" => $nivell
        ];
        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetchAll();

        if ($result) {
            return $result;
        } else{
            return null;
        }
    }

    public function updateTicketLevelById($id,$level){
        $levelUpdated = ($level == 1) ? 0 : 1;

        $sql = "UPDATE ticket SET nivell = :levelUpdated WHERE id = :id";
        $params =[
            ":id" => $id,
            ":levelUpdated" => $levelUpdated
        ];
        
        $db = new Database();
        $result = $db->queryDataBase($sql,$params);

        if ($result) {
            return $result;
        } else{
            return null;
        }

    }

    public function solveit($ticket,$solution,$dateClosed){
        $dateFinal = $dateClosed->format('Y-m-d H:i:s');
        $sql = "UPDATE ticket SET solucio = :solution, ticket_closed = :dateFinal WHERE id = :id";
        $params = [
            ":id" => $ticket['id'],
            ":solution" => $solution,
            ":dateFinal" => $dateFinal
        ];

        $db = new Database();
        $result = $db->queryDataBase($sql,$params);

        if ($result) {
            return $result;
        } else{
            return null;
        }

    }
}
