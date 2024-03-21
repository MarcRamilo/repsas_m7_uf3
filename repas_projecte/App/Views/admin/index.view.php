<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            margin-bottom: 50px;
            padding-left: 4rem;
            padding-right: 4rem;
        }

        .btn-action {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="text-center">
            <?php if (isset($params['flash']['ok'])) {
                echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
                unset($params['flash']['ok']);
            } ?>
            <?php if (isset($params['flash']['ko'])) {
                echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
                unset($params['flash']['ko']);
            } ?>
            <h2 class="mb-4">Benvingut/da <?php echo $params['user']['username'] ?></h2>
            <a href="/user/list" class="btn btn-primary btn-lg btn-action">Gestionar Usuaris</a>
            <a href="/curs/list" class="btn btn-success btn-lg btn-action">Gestionar Cursos</a>
            <a href="/ufs/list" class="btn btn-info btn-lg btn-action">Gestionar UFS</a>

        </div>
    </div>

    <!-- Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>