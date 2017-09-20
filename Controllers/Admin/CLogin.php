<?php
@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot.'/models/Admin/MLogin.php';
require_once $pRoot.'/libraries/SessionVars.php';

class CLogin {

    private $email;
    private $emailFilter;
    private $user;
    private $idUser;
    private $idLog;
    private $pass;
    private $ip;
    
    public function setEmail($email) {
        
        $this->email = $email;
        $this->emailFilter = "'".$email."'";
        
    }

    public function setPass($pass) {

        $this->pass = "'".sha1($pass)."'";
        
    }
    
    public function setIp($ip) {

        $this->ip = "'".$ip."'";
        
    }

    public function logIn() {
        
        $mLogin = new MLogin();
        $mLogin->logIn($this->emailFilter, $this->pass, $this->ip);
        $this->user = $mLogin->getUser();
        $this->idUser = $mLogin->getIdUser();
        $this->idLog = $mLogin->getIdLog();

        return $mLogin->getResponse();
        
    }
    
    public function setSession(){
        
        $sess = new SessionVars();
        $sess->init();
        $sess->setValue('user', $this->user);
        $sess->setValue('idUser', $this->idUser);
        $sess->setValue('email', $this->email);
        $sess->setValue('idLog', $this->idLog);
        
    }

}

if ((isset($_POST['email']) && isset($_POST['pass'])) && (!empty($_POST['email']) && !empty($_POST['pass']))) {

    $login = new CLogin();
    $login->setEmail($_POST['email']);
    $login->setPass($_POST['pass']);
    $login->setIp('192.168.1.111');
    $user = $login->logIn();
    if($user=="Ok")
        $login->setSession();
    
    echo $user;
 
}

?>