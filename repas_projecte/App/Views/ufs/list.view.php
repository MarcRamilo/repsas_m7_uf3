<!-- make a view for list card model de ufs -->
<!doctype html>
<html lang="en">

<head>
    <title> </title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>

    </header>
    <main>
        <div class="container">
            <div class="text-center">
                <h2 class="mb-4">Benvingut/da <?php echo $params['logged_user']['username'] ?? 'convidat' ?></h2>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($params['ufs'] as $uf) { ?>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="../../../Public/Assets/images/ufs_images/<?php echo $uf['ufs_images'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $uf['name'] ?></h5>
                                <p class="card-text">Contingut: <?php echo $uf['contingut'] ?></p>
                                <a href="/uf/show/?id=<?php echo $uf['id'] ?>" class="btn btn-primary">Veure UF</a>
                            </div>
       

                            <?php  include_once(__DIR__ . "../../../Models/Uf.php");?>
                            <?php  include_once(__DIR__ . "../../../Models/Curs.php");?>
                             <?php $ufModel = new Ufs();
                             $cursModel = new Curs();
                                        ?>
                            <?php if ($uf['curs_id'] != null) {
                                $UFc = $ufModel->getById($uf['curs_id']);
                                $curs = $cursModel->getById($UFc['curs_id']);
                                echo '<pre>';
                                var_dump($curs);
                                echo '</pre>';
                                echo '<p>Assignat a: <a href="/curs/show/?id=' . $curs['id'] . '">' . $curs['name'] . '</a></p>';
                            ?>
    
                            <?php  } else {
                            ?>
                            <form action="/ufs/assign" method="post">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Selecciona un curs</option>
                                    <?php foreach ($params['cursos'] as $curs) { ?>
                                        <option value="<?php echo $curs['id'] ?>"><?php echo $curs['name'] ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="uf_id" value="<?php echo $uf['id'] ?>">
                                <button type="submit" class="btn btn-primary">Assignar</button>
                                <?php } ?>
                                </form>
                        </div>
                    </div>
                <?php } ?>
            
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>