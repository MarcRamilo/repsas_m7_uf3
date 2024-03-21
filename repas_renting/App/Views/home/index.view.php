
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut/da al nostre restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php if(isset($params['flash']['ok'])) {
        echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
        unset($params['flash']['ok']);
    }?>
    <?php if(isset($params['flash']['ko'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
        unset($params['flash']['ko']);
    }?>
    <header class="bg-dark text-warning text-center py-5">
        <h1 class="display-4">Benvingut/da al nostre web de rents !</h1>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">Descobreix la nostra varietat de rents</h2>
         
                <img src="https://www.ctvnews.ca/content/dam/ctvnews/en/images/2023/4/15/e-scooter-1-6357268.jpg" class="img-fluid mx-auto" alt="Imatge del restaurant">
            </div>
        </div>
    </section>

    <div class="container mt-4" style="background-color:blanchedalmond;">
    <br>
        <h1 class="text-center mb-3">Benvingut <?php echo $_SESSION['logged_user']['name'] ?? 'convidat'; ?></h1>
        <h3 class="text-center mb-3">Reserva</h3>
      
        <?php 
            // $link = isset($_SESSION['logged_user']) ? "/plats/list" : "/user/login";
        ?>

        <a href="/scooter/list" class="btn btn-primary d-flex justify-content-center ">Visita els scooters</a>
        <br> <br>
    </div>
    <br>
        <br><br> <br>
        <br>
   
</body>
</html>