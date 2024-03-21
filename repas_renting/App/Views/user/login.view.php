<form action="/user/checkLogin" method="post">
<div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
<?php if(isset($params['flash']['ok'])) {
    echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
    unset($params['flash']['ok']);
    }?>
  <?php if(isset($params['flash']['ko'])) {
    echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
    unset($params['flash']['ko']);
    }?>
<h1>Login</h1>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text"
            class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Insereix el teu nom d'usuari">
        </div>
        <div class="mb-3">
          <label for="pass" class="form-label">Password</label>
          <input type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Insereix la contrassenya">
        </div>
        <div class="mb-3">
        <p>T'has registrat? <a href="/user/singup" class="">Registre't</a></p>
        </div>
        <button type="submit" class="btn btn-primary">Desa</button>
    </form>
    </div>