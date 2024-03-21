<!doctype html>
<html lang="en">
<?php

?>
<style>
    nav a:hover {
        color: blue;
        /* Cambia el color del texto a azul al pasar el mouse sobre el enlace */
    }

    footer {
        background-color: #343a40;
        color: white;
        text-align: center;
        padding: 20px;
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
        
        </div>
        <div class="right">
            <?php if (isset($_SESSION['logged_user'])) { ?>
                <a href="/user/logout" class="text-black text-decoration-none" style="font-size: 30px;"><strong>LogOut</strong></a>
                <?php if ($_SESSION['logged_user']['admin'] === 0) {
                    # code...
                ?>
                    <a href="/user/profile" class="text-black text-decoration-none" style="font-size: 30px;"><?php echo $_SESSION['logged_user']['username'] ?></a>
                <?php  } ?> <?php } else { ?>
                <a href="/user/singup" class="text-black text-decoration-none" style="font-size: 30px;"><strong>SignUp</strong></a>
                <a href="/user/login" class="text-black text-decoration-none" style="font-size: 30px;"><strong>Login</strong></a>
            <?php } ?>
            <?php
            $link_admin_home = "/user/admin";
            $link_user_home = "/user/home";
            ?>
            <a href="<?php echo $link_user_home ?>" class="text-black text-decoration-none" style="font-size: 30px;"><strong>Home</strong></a>
            <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === 1) { ?>
                <a href="/user/admin" class="text-black text-decoration-none" style="font-size: 30px;"><strong>Admin</strong></a>
            <?php } ?>
        </div>
    </nav>
    </header>
    <main>
        <?php echo $params['content'] ?>
    </main>
    <!-- <div class="mt-4">
        <footer>
            &copy; <?php echo date('Y'); ?> EASY EATS
        </footer>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>


</html>