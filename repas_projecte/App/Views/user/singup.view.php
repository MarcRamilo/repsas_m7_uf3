<form action="/user/store" method="post" enctype="multipart/form-data">
<?php if(isset($params['flash']['ok'])) {
    echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
    unset($params['flash']['ok']);
    }?>
  <?php if(isset($params['flash']['ko'])) {
    echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
    unset($params['flash']['ko']);
    }?>
  <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
    <h1>SignUp</h1>
    <?php if (isset($_SESSION['logged_user']['admin']) === true) : ?>
      <div class="mb-3">
        <label for="admin" class="form-label">Role</label>
        <select class="form-control" name="admin" id="admin">
          <option value="">Selecciona un rol</option>
          <option value="admin">Admin</option>
          <option value="client">Client</option>
        </select>
      </div>
    <?php endif; ?>
    <div class="mb-3">
      <label for="username" class="form-label" enctype="multipart/form-data">Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Insereix un nou nom d'Usuari" value="<?php echo $_POST['username']  ?? null; ?>">
    </div>
    <div class="mb-3">
      <label for="mail" class="form-label">Mail</label>
      <input type="text" class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="Insereix un nou Mail" value="<?php echo $_POST['mail']  ?? null; ?>">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Insereix una nova contrassenya" value="<?php echo $_POST['pass']  ?? null; ?>">
    </div>
    <div class="mb-3">
      <label for="profile_image" class="form-label">Profile Image</label>
      <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Desa</button>

  </div>
</form>
</div>