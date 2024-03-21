<form action="/user/storeEditUser" method="post" enctype="multipart/form-data">
    <?php if (isset($params['flash']['ok'])) {
        echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
        unset($params['flash']['ok']);
    } ?>
    <?php if (isset($params['flash']['ko'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
        unset($params['flash']['ko']);
    } ?>
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
        <h1>Edit User <?php echo  $params['user']['name'] ?> </h1>
        <?php if ($params['logged_user']['admin'] === 1) : ?>
            <div class="mb-3">
                <label for="admin" class="form-label">Role</label>
               <select class="form-control" name="admin" id="admin">
                    <option value="admin" <?php echo $params['user']['admin'] === 1 ? "selected" : "" ?>>Admin</option>
                    <option value="client" <?php echo $params['user']['admin'] === 0 ? "selected" : "" ?>>Client</option>
                </select>
            </div>
        <?php endif; ?>
        <!-- <div class="mb-3">
            <label>Imatge Acutal</label>
            <img src="../../../Public/Assets/images/profile_images/<?php echo $params['user']['profile_image']; ?>" alt="Perfil de <?php echo $params['user']['username']; ?>" class="img-fluid" style="max-width: 200px;">
            <br>
            <label for="profile_image" class="form-label">Change Profile Image</label>
            <input type="file" class="form-control" name="profile_image" id="profile_image" value="../../../Public/Assets/images/profile_images/<?php echo $params['user']['profile_image'] . ".jpg" ?>">
        </div> -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="" value="<?php echo $params['user']['username'] ?>">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="<?php echo $params['user']['name'] ?>">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="mb-3">
            <label for="direction" class="form-label">Direcció per enviament</label>
            <input type="text" class="form-control" name="direction" id="direction" aria-describedby="helpId" placeholder="" value="<?php echo $params['user']['direction'] ?>">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Mail</label>
            <input type="text" class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="" value="<?php echo  $params['user']['mail'] ?>">
            <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div>
            <div class="mb-3">
                <input type="checkbox" class="form-check-label" name="avisEnviamentPropaganda" id="avisEnviamentPropaganda" aria-describedby="helpId" checked />
                <label for="avisEnviamentPropaganda" class="form-label">Estàs interessat en rebre promoció?</label>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $params['user']['id'] ?>">
        <button type="submit" class="btn btn-primary">Desa</button>
    </div>
</form>