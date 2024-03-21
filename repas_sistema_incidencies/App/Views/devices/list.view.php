<!DOCTYPE html>
<html lang="en">
<?php
include_once(__DIR__ . "/../../Models/Device.php");
include_once(__DIR__ . "/../../Models/Types.php");
include_once(__DIR__ . "/../../Models/Users.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cursos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<!-- make it for scooter -->

<body>


    <div class="container">
        <h1 class="text-center mb-4">Llistat de dispositius</h1>
        <?php if (isset($params['flash']['ok'])) {
            echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
            unset($params['flash']['ok']);
        } ?>
        <?php if (isset($params['flash']['ko'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
            unset($params['flash']['ko']);
        } ?>
        <div class="row">
            <?php foreach ($params['devices'] as $d) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../../../Public/Assets/images/rent/<?= $d['img'] ?>" class="card-img-top" alt="<?= $scooter['model'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $d['model'] ?></h5>
                            <?php
                            $typesModel = new Types();
                            $devicesType = $typesModel->getName($d['type']);

                            ?>
                            <p class="card-text">Tipus: <?= $devicesType['type'] ?></p>
                            <?php
                            $userModel = new Users();
                            $userName = $userModel->getById($d['user']);

                            ?>
                            <p>Usuari: <?= $userName['username'] ?> </p>
                            <a class="btn btn-danger" href="/devices/delete/?id=<?= $d['id'] ?>">Eliminar dispositu</a>
                            <a class="btn btn-info" href="/ticket/incidence/?id=<?= $d['id'] ?>">Incidencia</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="mx-auto col-7">
        <a class="btn btn-primary " href="/devices/create">Registrar nou dispositu</a>
    </div>
</body>

<table class="table table-striped">
    <div class="m-4 p-4 col-5 mx-auto ">
        <h3>Incidencies Actives</h3>
    </div>
    <thead>
        <tr>
            <th>Identificador de Incidencia</th>
            <th>User</th>
            <th>Device</th>
            <th>Estat</th>
            <th>Prioritat</th>
            <th>Descrioption</th>
            <th>Solucio</th>
            <th>Nivell</th>
            <th>Ticket Opened</th>
            <th>Ticket Closed</th>
            <th>Acció 1</th>
            <th>Acció 2</th>
            <th>Acció 3</th>

        </tr>
    </thead>
    <tbody>

        <?php
        if (isset($params['ticket']) && is_array($params['ticket'])) {
            foreach ($params['ticket'] as $r) {
                if ($r['solucio'] == null) {

        ?>
                    <tr>
                        <td><?php echo $r['id']  ?? null ?></td>
                        <td><?php echo $r['user'] ?? null ?></td>
                        <td><?php echo $r['device'] ?? null ?></td>
                        <td><?php echo $r['estat'] ?></td>
                        <td><?php echo $r['prioritat']  ?? null ?></td>
                        <td><?php echo $r['description']  ?? null ?></td>
                        <td><?php echo $r['solucio']  ?? "No solucionat encara" ?> </td>
                        <td><?php echo $r['nivell']  ?? null ?></td>
                        <td><?php echo $r['ticket_opened'] ?? null  ?></td>
                        <td><?php echo $r['ticket_closed'] ?? "No tancat" ?></td>
                        <td><a class="btn btn-success" href="/ticket/solve/?id=<?= $r['id'] ?>">Resoldre Incidencia</a></td>
                        <td><a class="btn btn-info" href="/ticket/escalar/?id=<?= $r['id'] ?>">Escalar Incidencia</a></td>
                        <td><a class="btn btn-danger" href="/ticket/delete/?id=<?= $r['id'] ?>">Eliminar Incidencia</a></td>

                    </tr>
                <?php
                } else {



                ?>
                    <table class="table table-striped">
                        <div class="m-4 p-4 col-5 mx-auto ">
                            <h3>Incidencies Solventades</h3>
                        </div>
                        <thead>
                            <tr>
                                <th>Identificador de Incidencia</th>
                                <th>User</th>
                                <th>Device</th>
                                <th>Estat</th>
                                <th>Prioritat</th>
                                <th>Descrioption</th>
                                <th>Solucio</th>
                                <th>Nivell</th>
                                <th>Ticket Opened</th>
                                <th>Ticket Closed</th>
     
                            <tr>
                                <td><?php echo $r['id']  ?? null ?></td>
                                <td><?php echo $r['user'] ?? null ?></td>
                                <td><?php echo $r['device'] ?? null ?></td>
                                <td><?php echo $r['estat'] ?></td>
                                <td><?php echo $r['prioritat']  ?? null ?></td>
                                <td><?php echo $r['description']  ?? null ?></td>
                                <td><?php echo $r['solucio']  ?? "No solucionat encara" ?> </td>
                                <td><?php echo $r['nivell']  ?? null ?></td>
                                <td><?php echo $r['ticket_opened'] ?? null  ?></td>
                                <td><?php echo $r['ticket_closed'] ?? "No tancat" ?></td>
                               

                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                <?php      }
            }
        } ?>
                        </tbody>
                    </table>

                    <!-- Bootstrap JS (jQuery is required) -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                    </body>

</html>