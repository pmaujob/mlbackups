<?php
@session_start();
$pRootHtml = $_SESSION['pRootHtml'];

$userId = $_POST['userId'];

require_once '../../Models/FileManagement/MConsultUsers.php';

$dirs = MConsultUsers::getDirectorios($userId);
foreach ($dirs as $dir) {
    ?>
    <li class="collection-item avatar">
        <img class="circle" style="background-color: #2196F3; padding: 5px;" src="<?php echo "$pRootHtml/Views/images/inkscape/folder-open.svg"; ?>">
        <span class="title"><?php echo $dir[1]; ?></span>
    </li>
    <?php
}
?>