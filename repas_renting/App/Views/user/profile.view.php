<?php
$currentDate = date('Y-m-d');
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
                    <h2>Benvingut <?php echo $params['logged_user']['username']; ?> <!--(Rol: <?php //echo $_SESSION['logged_user']['role']; 
                                                                                                ?>)--></h2>
                </div>
                <div class="m-4 p-4 col-5 mx-auto ">
                    <h3>Informació del teu usuari</h3>
                </div>

                <table class="table table-striped">
                    <thead>
                        <th>Username</th>
                        <th>Mail</th>
                        <th>Profile Image</th>
                        <th>Role</th>

                    </thead>

                    <tbody>
                        <th> <?php echo $params['logged_user']['username']; ?></th>
                        <th> <?php echo $params['logged_user']['mail']; ?></th>
                        <th><img src="../../../Public/Assets/images/profile_images/<?php echo $params['logged_user']['profile_image'] ?>" alt="Imagen actual" style="max-width: 100px;"></th>
                        <th> <?php echo $params['logged_user']['admin'] ? 'admin' : 'client'; ?></th>

                    </tbody>
                </table>
                <table class="table table-striped">
    <div class="m-4 p-4 col-5 mx-auto ">
        <h3>Patinets</h3>
    </div>
    <thead>
        <tr>
            <th>Identificador de la Comanda</th>
            <th>Id Scooter</th>
            <th>Usuari</th>
            <th>Total Pagat</th>
            <th>rent_start</th>
            <th>Estat</th>
            <th>rent_end</th>
        </tr>
    </thead>
    <tbody>

        <?php
        if (isset($params['rent']) && is_array($params['rent'])) {
            foreach ($params['rent'] as $r) {
        ?>
                    <tr>
                        <td><?php echo $r['id'] ?></td>
                        <td><?php echo $r['id_scooter'] ?></td>
                        <td><?php echo $r['user'] ?></td>
                        <td><?php echo $r['price'] ?></td>
                        <td><?php echo $r['rent_start'] ?></td>
                        <td><?php echo $r['rent_end'] !== null ? 'Finalizado' : 'Activo' ?></td>
                        <td><?php echo $r['rent_end'] !== null ? $r['rent_end'] : '-' ?></td>
                    </tr>
        <?php
               
            }
        }
    }
        ?>
    </tbody>
</table>

            
        </div>
    </div>
</div>