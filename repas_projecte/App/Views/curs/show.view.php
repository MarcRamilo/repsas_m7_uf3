<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalls del Curs</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
        }

        .btn-action {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <h2 class="mb-4">Benvingut/da <?php echo $params['logged_user']['username'] ?? 'convidat' ?></h2>
            <?php if(isset($params['logged_user']) && $params['logged_user']['admin'] == 1){ ?>
            <a href="/curs/list" class="btn btn-primary btn-lg btn-action">Gestionar Cursos</a>
            <?php } ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div >
                <div >
                    <img src="../../../Public/Assets/images/cursos_images/<?php echo $params['curs']['curs_image'] ?>" class="card-img-top" alt="Imatge del Curs">
                    <div >
                        <h5 ><?php echo $params['curs']['name'] ?></h5>
                        <p >Descripció: <?php echo $params['curs']['description'] ?></p>
                        <p >Profe: <?php echo $params['curs']['profe'] ?></p>
                        <p >Ufs: <?php echo $params['curs']['ufs'] ?></p>
                        <p >Preu: <?php echo $params['curs']['preu'] ?></p>
                        <p >Data d'inici: <?php echo $params['curs']['data_inici'] ?></p>
                        <p >Data de fi: <?php echo $params['curs']['data_final'] ?></p>
                        <a href="/curs/list" class="btn btn-primary">Tornar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
