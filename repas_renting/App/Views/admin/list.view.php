<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>


    </style>
    <title><?php echo $params['title']; ?></title>
</head>

<body>

    <h2 class="text-center mt-4"><?php echo $params['title']; ?></h2>
    <?php if(isset($params['flash']['ok'])) {
        echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
        unset($params['flash']['ok']);
    }?>
    <?php if(isset($params['flash']['ko'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
        unset($params['flash']['ko']);
    }?>
   <div class="table-responsive p-4">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">Nom</th>
                    <th class="p-2">Usuari</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Direcció</th>
                    <th class="p-2">Imatge Perfil</th>
                    <th class="p-2">Avis Legal</th>
                    <th class="p-2">Avis Enviament Propaganda</th>
                    <th class="p-2">Verificat</th>
                    <th class="p-2">Admin</th>
                    <th class="p-2">Action 1</th>
                    <th class="p-2">Action 2</th>
                    <th class="p-2">Action 3</th>
                    <th class="p-2">Chat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['users'] as $user) : ?>
                    <tr>
                        <td class="p-2"><?php echo $user['id']; ?></td>
                        <td class="p-2"><?php echo $user['name']; ?></td>
                        <td class="p-2"><?php echo $user['username']; ?></td>
                        <td class="p-2"><?php echo $user['mail']; ?></td>
                        <td class="p-2"><?php echo $user['direction']; ?></td>
                        <td class="p-2"><img src="../../../Public/Assets/images/profile_images/<?php echo $user['profile_image']  ?> " alt="Perfil de <?php echo $user['username']; ?>" class="img-fluid" style="max-width: 100px;"></td>
                        <td class="p-2"><?php echo $user['avis_legal']; ?></td>
                        <td class="p-2"><?php echo $user['avis_enviament_propaganda']; ?></td>
                        <td class="p-2"><?php echo $user['verify']; ?></td>
                        <td class="p-2"><?php echo $user['admin']; ?></td>
                        <?php if ($user['username'] == "admin") { ?>
                            <td class="p-2"> <button href="#" class="btn btn-primary btn-sm" type="button" disabled >No es pot editar el Admin</button></td>
                            <td class="p-2"> <button href="#" class="btn btn-danger btn-sm" type="button" disabled>No es pot eliminar el Admin</button></td>
                            <td class="p-2"><button href="#" class="btn btn-info btn-sm" type="button" disabled>No té comandes Admin</button></td>
                            <td class="p-2"><button href="#" class="btn btn-success btn-sm" type="button" disabled>No es pot xatejar amb l'Admin</button>
                            </td>
                        <?php } else { ?>
                            <td class="p-2"><a  href="/user/edit/?id=<?php echo $user['id']?>" class="btn btn-primary btn-sm" >Editar</a></td>
                            <td class="p-2"> <a  href="/user/delete/?id=<?php echo $user['id']?>" class="btn btn-danger btn-sm" >Eliminar</a> </td>
                            <td class="p-2"> <a  href="/comanda/filterByUser/?id=<?php echo $user['id']?>" class="btn btn-info btn-sm" >Veure Comandes</a> </td>
                            <td class="p-2"> <a  href="/user/chatAdmin/?id=<?php echo $user['id']?>" class="btn btn-success btn-sm" >Chat</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a class="btn btn-primary" href="/user/singup">Crear Usuari</a>
    <!-- Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>