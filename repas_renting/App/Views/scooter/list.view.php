<!DOCTYPE html>
<html lang="en">

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
<?php
// Verificar si el usuario tiene un patinete alquilado
$userHasScooter = false;
foreach ($params['scooters'] as $scooter) {
    if ($scooter['user_rent'] == $_SESSION['logged_user']['id']) {
        $userHasScooter = true;
        break;
    }
}
?>

<div class="container">
    <h1 class="text-center mb-4">Llistat de scooters</h1>
    <div class="row">
        <?php foreach ($params['scooters'] as $scooter) : ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="../../../Public/Assets/images/rent/<?= $scooter['img'] ?>" class="card-img-top" alt="<?= $scooter['model'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $scooter['model'] ?></h5>
                        <p class="card-text">Preu: <?= $scooter['price'] ?>€/min</p>
                        <?php if ($scooter['user_rent'] == null) { ?>
                            <?php if (!$userHasScooter) { ?>
                                <a href="/rent/renting/?id=<?= $scooter['id'] ?>" class="btn btn-primary">Llogar</a>
                            <?php } else { ?>
                                <p class="text-danger">Ja tens un patinet llogat.</p>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (isset($_SESSION['logged_user']) && $scooter['user_rent'] == $_SESSION['logged_user']['id']) { ?>
                                <a href="/rent/returning/?id=<?= $scooter['id'] ?>" class="btn btn-primary">Retornar</a>
                            <?php } else { ?>
                                <button class="btn btn-danger" type="button" disabled>No disponible</button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>



<!-- Bootstrap JS (jQuery is required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>