<?php 
include_once(__DIR__ . "/../../Models/Users.php");
include_once(__DIR__ . "/../../Models/Device.php");
?>
<form action="/ticket/solved" method="post">
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
        <?php if (isset($params['flash']['ok'])) {
            echo "<div class='alert alert-success' role='alert'>" . $params['flash']['ok'] . "</div>";
            unset($params['flash']['ok']);
        } ?>
        <?php if (isset($params['flash']['ko'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $params['flash']['ko'] . "</div>";
            unset($params['flash']['ko']);
        } ?>
        <h1 class="alert alert-danger">Solucionar INCIDENCIA numero <?= $params['ticket']['id'] ?></h1>
        <p>Problema: <?php echo $params['ticket']['description'] ?></p>
        <?php 
        $userModel = new Users();
        $user =$userModel->getById($params['ticket']['user']);
        ?>
        <p>User que ha notificat la incidencia: <?php echo $user['username'] ?></p>
        <?php 
        $deviceModel = new Device();
        $device = $deviceModel->getById($params['ticket']['device']);
        ?>
        <p>Info del Device:</p>
        <li>
            <ul>Model:<?= $device['model'] ?></ul>
            <ul> <img src="../../../Public/Assets/images/rent/<?=$device['img'] ?>"> </ul>
            <?php 
            $typeModel = new Types();
            $type = $typeModel->getName($device['type']);
            ?>
            <ul>Type:<?= $type['type'] ?></ul>
        </li>
        <div class="mb-3">
            <label for="solution" class="form-label">Solució</label>
            <textarea class="form-control" name="solution" id="solution" rows="3"></textarea>
        </div>
        <input hidden name="id" value="<?= $params['ticket']['id']?>">
        <button type="submit" class="btn btn-primary">
            Desar
        </button>

    </div>
</form>