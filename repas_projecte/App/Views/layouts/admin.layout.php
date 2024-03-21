<!doctype html>
<html lang="en">

<style>
  nav a:hover {
    color: blue;
    /* Cambia el color del texto a azul al pasar el mouse sobre el enlace */
  }

  footer {
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>

<head>
  <title><?php echo $params['title'] ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <nav class="py-3 px-2 text-white d-flex justify-content-between" style="background-color: blanchedalmond; align-items: center;">
    <div class="left d-flex align-items-center">
      <a href="/user/home">
        <img src="/Public/Assets/images/profile_images/logo.png" class="align-middle" alt="logo" width="140px" height="140px">
      </a>
    </div>
    <div class="right">
      <?php if (isset($_SESSION['logged_user'])) { ?>
        <a href="/user/logout" class="text-black text-decoration-none" style="font-size: 30px;">LogOut</a>
        <?php if ($_SESSION['logged_user']['admin'] === 0) {
          # code...
        ?>
          <a href="/user/profile" class="text-black text-decoration-none" style="font-size: 30px;"><?php echo $_SESSION['logged_user']['name'] ?></a>

        <?php  } ?>
      <?php } else { ?>
        <a href="/user/create" class="text-black text-decoration-none" style="font-size: 30px;">SignUp</a>
        <a href="/user/index" class="text-black text-decoration-none" style="font-size: 30px;">Login</a>
      <?php } ?>
      <a href="/" class="text-black text-decoration-none" style="font-size: 30px;">Reset</a>
      <a href="/user/admin" class="text-black text-decoration-none" style="font-size: 30px;" style="font-size: 30px;">Admin</a>
    </div>
  </nav>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

    <?php echo $params['content'] ?>
  </main>
  <!-- <footer>
    &copy; <?php echo date('Y'); ?> EASY EATS
  </footer> -->

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>