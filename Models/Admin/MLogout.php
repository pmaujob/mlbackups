<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot.'/libraries/ConnectionDB.php';

class MLogout {
    
    public static function logOut($idLog){
        
        $sql = 'select from seguridad.logs_logout('.$idLog.');';
        
        $con = new ConnectionDB();
        $con->connect("PG");
        $con->consult($sql);
        
        $con->closeConnection();
        
    }
    
}

?>
