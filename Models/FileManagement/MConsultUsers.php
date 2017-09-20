<?php

@session_start();
$pRoot = $_SESSION['pRoot'];

require_once '../../Libraries/ConnectionDB.php';

class MConsultUsers {

    public static function getUsers($searchValue) {

        $consult = "SELECT ud.id_eudatos,"//0
                . "ud.id_eusuario,"//1
                . "ud.responsable,"//2
                . "a.descripcion "//3
                . "FROM eudatos AS ud "
                . "INNER JOIN areas AS a ON ud.id_area = a.id_area "
                . "WHERE lower(ud.responsable) LIKE '%" . strtolower($searchValue) . "%' "
                . "OR lower(a.descripcion) LIKE '%" . strtolower($searchValue) . "%' "
                . "AND ud.estado = '1' "
                . "ORDER BY ud.responsable ASC;";

        $con = new ConnectionDB();
        $con->connect("PG");
        $res = $con->consult($consult);
        $con->closeConnection();

        return $res;
    }

    public static function getEeudatos($idEudatos) {

        $consult = "SELECT ud.id_eudatos,"//0
                . "us.id_eusuario,"//1
                . "us.cuenta,"//2
                . "ud.responsable,"//3
                . "ud.ipsync,"//4
                . "ud.ultimo_registro,"//5
                . "ud.ultima_ip "//6
                . "FROM eudatos AS ud "
                . "INNER JOIN eusuarios AS us ON ud.id_eusuario = us.id_eusuario "
                . "WHERE ud.id_eudatos = $idEudatos;";

        $con = new ConnectionDB();
        $con->connect("PG");
        $res = $con->consult($consult);
        $con->closeConnection();

        return $res;
    }

    public static function getDirectorios($idEudatos) {

        $consult = "SELECT d.id_dir,"//0
                . "d.directorio "//1
                . "FROM eudatos AS ud "
                . "INNER JOIN directorios AS d ON ud.id_eudatos = d.id_eudatos "
                . "WHERE ud.id_eudatos = $idEudatos;";

        $con = new ConnectionDB();
        $con->connect("PG");
        $res = $con->consult($consult);
        $con->closeConnection();

        return $res;
    }

}
?>

