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

<body>
    <div class="container">
        <div class="text-center">
            <h2>Benvingut/da <?php echo isset($params['logged_user']['username']) ? $params['logged_user']['username'] : 'convidat' ?></h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($params['cursos'] as $curs) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="../../../Public/Assets/images/cursos_images/<?php echo $curs['curs_image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $curs['name'] ?></h5>
                            <p class="card-text">Profe: <?php echo $curs['profe'] ?></p>
                            <a href="/curs/show/?id=<?php echo $curs['id'] ?>" class="btn btn-primary">Veure Curs</a>
                            <select name="profe" id="profe">
                                <option>Selecciona un profesor</option>
                                <?php foreach ($params['profesors'] as $p) { ?>
                                    <option value="<?php echo $p['id'] ?>"><?php echo $p['username'] ?></option>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (isset($params['logged_user']) && $params['logged_user']['admin'] == 1) { ?>
        <div class="container text-center">
            <a href="/curs/create" class="btn btn-primary btn-lg">Crear Curs</a>
        </div>
    <?php } ?>

    <!-- Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
