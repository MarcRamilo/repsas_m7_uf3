<!-- make a view to change de image profile -->
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h1 class="text-center">Editar Imatge de Perfil</h1>
        </div>
    </div>
    <?php if (isset($params['flash']['ok'])) {
        echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
        unset($params['flash']['ok']);
    } ?>
    <?php if (isset($params['flash']['ko'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
        unset($params['flash']['ko']);
    } ?>
    <div class="row">
        <div class="col-12">
        <?php if (!empty($params['user']['profile_image'])) : ?>
                        <img src="../../../Public/Assets/images/profile_images/<?php echo $params['user']['profile_image'] ?>" alt="Imagen actual" style="max-width: 100px;">
                    <?php endif; ?>
            <form action="/user/storeEditImageProfile" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $params['user']['id'] ?>">
                <div class="mb-3">
                    <label for="image" class="form-label">Imatge de Perfil</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Desa</button>
            </form>
        </div>
    </div>