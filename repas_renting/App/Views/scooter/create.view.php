<!-- form for create curs -->
<form action="/curs/store" method="post" enctype="multipart/form-data">
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
        <?php if (isset($params['flash']['ok'])) {
            echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
            unset($params['flash']['ok']);
        } ?>
        <?php if (isset($params['flash']['ko'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
            unset($params['flash']['ko']);
        } ?>
        <h1>Create Curs</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['name'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="ufs" class="form-label">Ufs</label>
            <input type="text" class="form-control" name="ufs" id="ufs" aria-describedby="helpId" placeholder="ex: 1,2,3,4 per Ids de UFS" value="<?php echo $_POST['ufs'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="curs_image" class="form-label">Curs Image</label>
            <input type="file" class="form-control" name="curs_image" id="curs_image" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['curs_image'] ?? null ?>" />
        </div>
        <select name="profe" id="profe">
            <option>Selecciona un profesor</option>
            <?php foreach ($params['profesors'] as $p) { ?>
                <option value="<?php echo $p['id'] ?>"><?php echo $p['username'] ?></option>
            <?php } ?>
        </select>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" value="<?php echo $_POST['description'] ?? null ?>"></textarea>
        </div>
        <div class="mb-3">
            <label for="preu" class="form-label">Price</label>
            <input type="number" class="form-control" name="preu" id="preu" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['number'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="data_inici" class="form-label">Data inici</label>
            <input type="date" class="form-control" name="data_inici" id="data_inici" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['data_inici'] ?? null ?>" />
        </div>
        <div class="mb-3">
            <label for="data_final" class="form-label">Data final</label>
            <input type="date" class="form-control" name="data_final" id="data_final" aria-describedby="helpId" placeholder="" value="<?php echo $_POST['data_final'] ?? null ?>" />
        </div>
        <button type="submit" class="btn btn-primary">
            Desar
        </button>

    </div>
</form>