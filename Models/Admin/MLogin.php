<?php
@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot.'/libraries/ConnectionDB.php';

class MLogin {
    
    private $con;
    private $email;
    private $user;
    private $idUser;
    private $idLog;
    private $response;

    public function logIn($email, $pass, $ip) {
        
        $this->con = new ConnectionDB();
        $this->con->connect("PG");
        
        $this->email = $email;

        $sql = 'select cont from seguridad.login(' . $email . ',' . $pass . ') as ("cont" varchar);';

        $res = $this->con->consult($sql);

        $response = "No";

        while ($result = $res->fetch(PDO::FETCH_OBJ)){
            $response = $result->cont;
        }

        if ($response == "Ok") {

            $sql = 'select id from seguridad.ing_logs_login(' . $ip . ',' . $email . ') as ("id" integer);';
            
            $res = $this->con->consult($sql);
            
            while ($result = $res->fetch(PDO::FETCH_OBJ)){
                $this->idLog = $result->id;
            }
            
            $this->setDataUsers();
            
        }

        $this->con->closeConnection();

        $this->response = $response;
        
    }
    
    private function setDataUsers(){
        
        $sql = 'select usuario, id from seguridad.get_datos_usuario('.$this->email.') as ("usuario" varchar, "id" varchar);';
        
        $res = $this->con->consult($sql);
        
        while ($resultado = $res->fetch(PDO::FETCH_OBJ)){
            $this->user = $resultado->usuario;
            $this->idUser = $resultado->id;
        }
        
    }
    
    public function getUser(){
        
        return $this->user;
        
    }
    
    public function getIdUser(){
        
        return $this->idUser;
        
    }
    
    public function getIdLog(){
        
        return $this->idLog;
        
    }
    
    public function getResponse(){
        
        return $this->response;
        
    }

}

?>