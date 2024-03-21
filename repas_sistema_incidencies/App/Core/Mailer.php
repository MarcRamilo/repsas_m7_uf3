<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';

class Mailer extends PHPMailer
{

    function mailServerSetup()
    {
        // $this->SMTPDebug = 4;
        // $this->SMTPDebug = SMTP::DEBUG_SERVER;
        // $this->SMTPDebug = SMTP::DEBUG_CONNECTION;
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->SMTPAutoTLS = false;
        $this->Username = 'marcramilogarrido04@gmail.com';
        $this->Password = 'ocyjrgcmqskasfiu';
        $this->SMTPSecure = 'tls'; 
        $this->Port = 587 ;
    }

    /**
     * @throws Exception
     */
    function addRec($to, $cc, $bcc)
    {
        $this->setFrom('', '');

        foreach ($to as $address) {
            $this->addAddress($address);
        }

        foreach ($cc as $address) {
            $this->addCC($address);
        }

        foreach ($bcc as $address) {
            $this->addBCC($address);
        }
    }
     /**
     * @throws Exception
     */
    function addAttach($att)
    {
        foreach ($att as $attachment) {
            $this->addAttachment($attachment);
        }
    }
     /**
     * @throws Exception
     */
    function addVeifyContent($user = null)
    {
        $this->isHTML(true);
        $this->Subject = 'Verifica la teva compte';
        $content = 'Hola ' . $user['name'];
        $content .= '<p>Gracies per registrar-te en la nostre web, per verificar la teva compte has de fer-ho fent click en el siguent enllaç:</p>
        <a style="padding:4px; background-color: red; color:white text-decoration-color:unset;" href="http://localhost/user/verify/?username=' . $user['username'] . "&token=" . $user['token'] .'">Verificar compte</a>';
       $this->Body = $content;
    }
    function addContentChat($content){
        $this->isHTML(true);
        $this->Subject = 'Missatge de ' . $_SESSION['logged_user']['username'];
        $this->Body = $content;

    }
    public function orderDelivered($user, $comanda)
{
    $this->isHTML(true);
    $this->Subject = 'Comanda entregada';

    $css = "
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #333;
            }
            p {
                color: #666;
                margin-bottom: 10px;
            }
            .comanda-details {
                background-color: #f9f9f9;
                padding: 10px;
                border-radius: 5px;
            }
            .comanda-details table {
                width: 100%;
            }
            .comanda-details th, .comanda-details td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }
        </style>
    ";

    $content = "
    <div class='container'>
        <h2>Hola {$user['name']},</h2>
        <p>La teva comanda amb identificador {$comanda['id']} ha estat entregada.</p>
        <div class='comanda-details'>
            <h3>Detalls de la comanda:</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>ID User</th>
                    <th>Productes</th>
                    <th>Total</th>
                    <th>Data</th>
                    <th>Estat</th>
                    <th>Entrega</th>
                </tr>
                <tr>
                    <td>{$comanda['id']}</td>
                    <td>{$comanda['id_user']}</td>
                    <td>{$comanda['productes']}</td>
                    <td>{$comanda['total']}</td>
                    <td>{$comanda['data']}</td>
                    <td>{$comanda['estat']}</td>
                    <td>{$comanda['entrega']}</td>
                </tr>
            </table>
        </div>
    </div>
";

    $this->Body = $css . $content;
}
    // public function orderSended($user, $comanda)
    // {
    //     $this->isHTML(true);
    //     $this->Subject = 'Comanda realitzada correctament';

    //     $css = "
    //         <style>
    //             body {
    //                 font-family: Arial, sans-serif;
    //                 background-color: #f4f4f4;
    //                 padding: 20px;
    //             }
    //             .container {
    //                 max-width: 600px;
    //                 margin: 0 auto;
    //                 background-color: #fff;
    //                 padding: 20px;
    //                 border-radius: 10px;
    //                 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    //             }
    //             h2 {
    //                 color: #333;
    //             }
    //             p {
    //                 color: #666;
    //                 margin-bottom: 10px;
    //             }
    //             .comanda-details {
    //                 background-color: #f9f9f9;
    //                 padding: 10px;
    //                 border-radius: 5px;
    //             }
    //             .comanda-details table {
    //                 width: 100%;
    //             }
    //             .comanda-details th, .comanda-details td {
    //                 padding: 8px;
    //                 border-bottom: 1px solid #ddd;
    //             }
    //         </style>
    //     ";

    //     $content = "
    //     <div class='container'>
    //         <h2>Hola {$user['name']},</h2>
    //         <p>La teva comanda amb identificador {$comanda['id']} ha estat realitzada correctament en 24/48h és realitzara l'enviament.</p>
    //         <div class='comanda-details'>
    //             <h3>Detalls de la comanda:</h3>
    //             <table>
    //                 <tr>
    //                     <th>ID</th>
    //                     <th>ID User</th>
    //                     <th>Productes</th>
    //                     <th>Total</th>
    //                     <th>Data</th>
    //                     <th>Estat</th>
    //                     <th>Entrega</th>
    //                 </tr>
    //                 <tr>
    //                     <td>{$comanda['id']}</td>
    //                     <td>{$comanda['id_user']}</td>
    //                     <td>{$comanda['productes']}</td>
    //                     <td>{$comanda['total']}</td>
    //                     <td>{$comanda['data']}</td>
    //                     <td>{$comanda['estat']}</td>
    //                     <td>{$comanda['entrega']}</td>
    //                 </tr>
    //             </table>
    //         </div>
    //     </div>
    // ";
    
    //         $this->Body = $css . $content;
    //     }
        public function orderDeleted($user, $comanda)
        {
            $this->isHTML(true);
            $this->Subject = 'Comanda eliminada';
    
            $css = "
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #666;
                        margin-bottom: 10px;
                    }
                    .comanda-details {
                        background-color: #f9f9f9;
                        padding: 10px;
                        border-radius: 5px;
                    }
                    .comanda-details table {
                        width: 100%;
                    }
                    .comanda-details th, .comanda-details td {
                        padding: 8px;
                        border-bottom: 1px solid #ddd;
                    }
                </style>
            ";
    
            $content = "
            <div class='container'>
                <h2>Hola {$user['name']},</h2>
                <p>La teva comanda amb identificador {$comanda['id']} ha estat eliminada.</p>
                <div class='comanda-details'>
                    <h3>Detalls de la comanda:</h3>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>ID User</th>
                            <th>Productes</th>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Estat</th>
                            <th>Entrega</th>
                        </tr>
                        <tr>
                            <td>{$comanda['id']}</td>
                            <td>{$comanda['id_user']}</td>
                            <td>{$comanda['productes']}</td>
                            <td>{$comanda['total']}</td>
                            <td>{$comanda['data']}</td>
                            <td>{$comanda['estat']}</td>
                            <td>{$comanda['entrega']}</td>
                        </tr>
                    </table> 
                </div>
            </div>
        ";
        
                $this->Body = $css . $content;
            }
}
