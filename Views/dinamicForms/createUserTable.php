<?php

@session_start();

$pRoot = $_SESSION['pRoot'];
$userId = $_POST['userId'];

require_once $pRoot . '/Models/FileManagement/MConsultUsers.php';

$user = MConsultUsers::getEeudatos($userId);
$dirs = MConsultUsers::getDirectorios($userId);

?>
<table>
    <?php
    foreach ($user as $row) {
        ?>
        <tr>
            <th>
                Responsable:&nbsp;
            </th>
            <th>
                <?php echo $row[3]; ?>
            </th>
        </tr>
        <tr>
            <th>
                Cuenta:&nbsp;
            </th>
            <th>
                <?php echo $row[2]; ?>
            </th>
        </tr>
        <tr>
            <th>
                IP:&nbsp;
            </th>
            <th>
                <?php echo $row[4]; ?>
            </th>
        </tr>
        <tr>
            <th>
                Último Registro:&nbsp;
            </th>
            <th>
                <?php echo $row[5]; ?>
            </th>
        </tr>
        <tr>
            <th>
                Última IP:&nbsp;
            </th>
            <th>
                <?php echo $row[6]; ?>
            </th>
        </tr>
        <?php
    }
    ?>
</table>
<span>Directorios:</span>
<ul>
    <?php
    foreach ($dirs as $dir) {
        ?>
        <li><?php echo $dir[1]; ?></li>
        <?php
    }
    ?>
</ul>