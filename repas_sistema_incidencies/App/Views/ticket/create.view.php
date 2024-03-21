<!-- form for create curs -->
<form action="/ticket/store" method="post">
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
        <?php if (isset($params['flash']['ok'])) {
            echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
            unset($params['flash']['ok']);
        } ?>
        <?php if (isset($params['flash']['ko'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
            unset($params['flash']['ko']);
        } ?>
        <h1 class="alert alert-danger">Registrar una nova INCIDENCIA</h1>
        <div class="mb-3">
            <label for="user" class="form-label">Usuari</label>
            <select name="user" id="user">
                <option value="<?php echo $params['user']['id'] ?>"><?php echo $params['user']['username'] ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="device" class="form-label">Device</label>
            <select name="device" id="device">
                <option value="<?php echo $params['device']['id'] ?>"><?php echo $params['device']['model'] ?></option>
            </select>
        </div>
  
        <div class="mb-3">
            <label for="prioritat" class="form-label">Prioritat</label>
            <select name="prioritat" id="prioritat">
                <option value="baixa">BAIXA</option>
                <option value="mitjana">MITJANA</option>
                <option value="alta">ALTA</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="decription" class="form-label">Descripció</label>
            <textarea class="form-control" name="decription" id="decription" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">
            Desar
        </button>

    </div>
</form>