<?php
$currentDate = date('Y-m-d');
include_once(__DIR__ . "../../../Models/Types.php");
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
                        <th><?php echo ($params['logged_user']['admin'] == 0) ? 'tecnic1' : (($params['logged_user']['admin'] == 1) ? 'admin1' : (($params['logged_user']['admin'] == 2) ? 'admin' : 'res')); ?></th>

                    </tbody>
                </table>
                <table class="table table-striped">
                    <div class="m-4 p-4 col-5 mx-auto ">
                        <h3>Patinets</h3>
                    </div>
                    <thead>
                        <tr>
                            <th>Identificador del dispositiu</th>
                            <th>Model</th>
                            <th>Imatge</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Creaated_at</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($params['devices']) && is_array($params['devices'])) {
                            foreach ($params['devices'] as $r) {
                        ?>
                                <tr>
                                    <td><?php echo $r['id']  ?? null ?></td>
                                    <td><?php echo $r['model'] ?? null ?></td>
                                    <td><img src="../.././../Public/Assets/images/rent/<?php echo $r['img'] ?>"></td>
                                    <td><?php echo $r['user']  ?? null ?></td>

                                    <?php
                                    $typeModel = new Types();
                                    $type = $typeModel->getName($r['type']);
                                    ?>
                                    <td><?php echo $type['type']  ?? null ?></td>
                                    <td><?php echo $r['created_at'] ?? null  ?></td>
                                    <td><?php echo $r['rent_end'] ?? null ?></td>
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