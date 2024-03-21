<?php
$currentDate = date('Y-m-d');
include_once(__DIR__ . "/../../Models/Plat.php");
?>
<title><?php echo $params['title'] ?></title>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (isset($params['flash']['ok'])) {
                echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
                unset($params['flash']['ok']);
            } ?>
            <?php if (isset($params['flash']['ko'])) {
                echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
                unset($params['flash']['ko']);
            } ?>
            <?php if (isset($params['logged_user']) && $params['logged_user']['admin'] === 0) { ?>
                <div class="m-4 p-4 col-5 mx-auto ">
                    <h2>Benvingut <?php echo $params['logged_user']['name']; ?> <!--(Rol: <?php //echo $_SESSION['logged_user']['role']; 
                                                                                            ?>)--></h2>
                </div>
                <div class="m-4 p-4 col-5 mx-auto ">
                    <h3>Informació del teu usuari</h3>
                </div>

                <table class="table table-striped">
                    <thead>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Mail</th>
                        <th>Profile Image</th>
                        <th>Role</th>
                        <th>Avis Legal</th>
                        <th>Acceptació Enviament Propaganda</th>
                        <th>Verificat</th>
                        <th>Acció 1</th>
                        <th>Acció 2</th>
                        <th>Acció 3</th>
                    </thead>
           
                    <tbody>
                        <th> <?php echo $params['logged_user']['username']; ?></th>
                        <th><?php echo $params['logged_user']['name']; ?></th>
                        <th> <?php echo $params['logged_user']['mail']; ?></th>
                        <th><img src="../../../Public/Assets/images/profile_images/<?php echo $params['logged_user']['profile_image'] ?>" alt="Imagen actual" style="max-width: 100px;"></th>
                        <th> <?php echo $params['logged_user']['admin'] ? 'admin' : 'client'; ?></th>
                        <?php //echo $params['logged_user']['password']; 
                        ?>
                        <th> <?php echo $params['logged_user']['avis_legal'] ? 'si' : 'no'; ?></th>
                        <th> <?php echo $params['logged_user']['avis_enviament_propaganda'] ? 'si' : 'no'; ?></th>
                        <th> <?php echo $params['logged_user']['verify'] ? 'si' : 'no'; ?></th>
                        <td><a href="/user/edit/?id=<?php echo $_SESSION['logged_user']['id']; ?>" class="btn btn-primary">Editar</a></td>
                        <td><a href="/user/chatUser/?id=<?php echo $_SESSION['logged_user']['id']; ?>" class="btn btn-success">Chat</a></td>
                        <td><a style="color:white;" class="btn btn-info" href="/user/editImageProfile">Canviar Fotu Perifl</a></td>
                    </tbody>
                </table>
                <table class="table table-striped">
                    <div class="m-4 p-4 col-5 mx-auto ">
                        <h3>Comandes Actives</h3>
                    </div>
                    <thead>
                        <tr>
                            <th>Identificador de la Comanda</th>
                            <th>Id Usuari</th>
                            <th>Productes</th>
                            <th>Total Pagat</th>
                            <th>Data de la Comanda</th>
                            <th>Estat</th>
                            <th>Entrega</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($params['comandes'])) {
                            foreach ($params['comandes'] ?? null as $c) {
                                if ($params['logged_user'] && $c['entrega'] === "Pendent") {

                        ?>
                                    <tr>
                                        <td><?php echo $c['id'] ?? null; ?></td>
                                        <td><?php echo $c['id_user'] ?? null; ?></td>
                                        <?php
                                        $platTitles = ''; 
                                        $platModel = new Plat();
                                        $productes = explode(",", $c['productes']);
                                        $productes = array_map('intval', $productes);
                                        foreach ($productes as $p) {
                                            $plat = $platModel->getById($p);
                                            if ($plat) { 
                                                $platTitles .= $plat['title'] . ","; 
                                            }
                                        }
                                        ?>
                                        <td><?php echo rtrim($platTitles, ',') ?? null; ?></td>
                                        <td><?php echo $c['total'] . "€" ?? null; ?></td>
                                        <td><?php echo $c['data'] ?? null; ?></td>
                                        <td><?php echo $c['estat'] ?? null; ?></td>
                                        <td><?php echo $c['entrega'] ?? null ?></td>

                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <table class="table table-striped">
                    <div class="m-4 p-4 col-5 mx-auto  ">
                        <h3>Comandes passades</h3>
                    </div>
                    <thead>
                        <tr>
                            <th>Identificador de la Comanda</th>
                            <th>Id Usuari</th>
                            <th>Productes</th>
                            <th>Total Pagat</th>
                            <th>Data de la Comanda</th>
                            <th>Estat</th>
                            <th>Entrega</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($params['comandes'])) {
                            foreach ($params['comandes'] ?? null as $c) {
                                if ($params['logged_user'] && $c['entrega'] === "Entregat") {

                        ?>
                                    <tr>
                                        <td><?php echo $c['id'] ?? null; ?></td>
                                        <td><?php echo $c['id_user'] ?? null; ?></td>
                                        <td><?php echo $c['productes'] ?? null; ?></td>
                                        <td><?php echo $c['total'] . "€" ?? null; ?></td>
                                        <td><?php echo $c['data'] ?? null; ?></td>
                                        <td><?php echo $c['estat'] ?? null; ?></td>
                                        <td><?php echo $c['entrega'] ?? null ?></td>

                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else if ((isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true)) { ?>
                <h1>Llista d'usuaris</h1>
                <table class="table table-striped text-">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Mail</th>
                            <th>Profile Image</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Avis Legal</th>
                            <th>Acceptació EnviamentPropaganda</th>
                            <th>Verificat</th>
                            <th>Acció 1</th>
                            <th>Acció 2</th>
                            <th>Acció 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($params['llista'] as $u) { ?>
                            <tr>
                                <td><?php echo $u['username'] ?></td>
                                <td><?php echo $u['name'] ?></td>
                                <td><?php echo $u['mail'] ?></td>
                                <td>
                                    <img src="../../../Public/Assets/images/profile_images/<?php echo $u['username']; ?>.jpg" alt="Perfil de <?php echo $u['username']; ?>" class="img-fluid" style="max-width: 200px;">
                                </td>
                                <td><?php echo $u['admin'] ? 'admin' : 'client'; ?> </td>
                                <td><?php echo $u['pass'] ?></td>
                                <td><?php echo $u['avisLegalDades'] ? 'si' : 'no'; ?> </td>
                                <td><?php echo $u['avisEnviamentPropaganda'] ? 'si' : 'no'; ?> </td>
                                <td><?php echo isset($u['verified']) && $u['verified'] ? 'si' : 'no'; ?> </td>
                                <?php if (isset($u['username']) && $u['username'] === 'admin') : ?>
                                    <td> <?php echo "No pots editar l'usuari admin"; ?> </td>
                                    <td> <?php echo "No pots eliminar l'usuari admin"; ?> </td>
                                <?php else : ?>
                                    <td><a href="/user/edit/?id_user=<?php echo $u['username']; ?>" class="btn btn-primary">Editar</a></td>
                                    <td><a href="/user/delete/?id_user=<?php echo $u['username']; ?>" class="btn btn-danger">Eliminar</a></td>
                                    <td><a href="/user/chatAdmin/?id_user=<?php echo $u['username']; ?>" class="btn btn-success">Chat</a></td>

                                <?php endif; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="/user/create" class="btn btn-primary">Crear usuari</a>
            <?php } ?>
        </div>
    </div>
</div>