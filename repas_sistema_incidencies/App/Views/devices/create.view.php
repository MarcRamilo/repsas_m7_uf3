<!-- form for create curs -->
<form action="/devices/store" method="post" enctype="multipart/form-data">
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
        <?php if (isset($params['flash']['ok'])) {
            echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
            unset($params['flash']['ok']);
        } ?>
        <?php if (isset($params['flash']['ko'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
            unset($params['flash']['ko']);
        } ?>
        <h1>Registrar devices</h1>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" name="model" id="model" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['model'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['image'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Usuari</label>
            <select name="user" id="user">
                <option>Selecciona un usuari</option>
                <?php foreach ($params['users'] as $p) { ?>
                    <option value="<?php echo $p['id'] ?>"><?php echo $p['username'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Tipus</label>
            <select name="type" id="type">
                <option>Selecciona un tipus</option>
                <?php foreach ($params['types'] as $p) { ?>
                    <option value="<?php echo $p['id'] ?>"><?php echo $p['type'] ?></option>
                <?php } ?>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">
            Desar
        </button>

    </div>
</form>