<?php
@session_start();

$pRoot = $_SESSION['pRoot'];
$pRootHtml = $_SESSION['pRootHtml'];

require_once $pRoot . '/Libraries/SessionVars.php';

$sess = new SessionVars();

if($sess->exist() && $sess->varExist('user')){

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
<?php include_once 'header.php'; ?>
    </head>
    <body>

<?php include_once '../Views/menu.php'; ?>
        <div class="container-fluid">
            <div class="col s12 m8 l10">

                <div class="row">
                    <div class="col s12 m8 l12 center-align bajarimagen">
<!--                        <div><img src="images/logoUser.png" width="300"></div>-->
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="col s12 m8 l9">

    </div>
</body>
</html>

<?php

}else{
    
    header("Location: $pRootHtml");
    
}

?>