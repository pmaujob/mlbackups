<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot . '/Class/FileManagement/DataFiles.php';
require_once $pRoot . '/Models/FileManagement/MLoadDataFiles.php';
require_once $pRoot . '/Libraries/ConvertFormats.php';

class CLoadDataFiles {

    private $users = array();
    private $usersToJson;

    private function getUsers() {
        return $this->users;
    }

    function getUsersToJson() {
        return $this->usersToJson;
    }

    function setUsersToJson($usersToJson) {
        $this->usersToJson = $usersToJson;
    }

    public function setDataFilePasswd() {
        
        try {

            $file = fopen("passwd", "r") or exit("Unable to open file!");

            while (!feof($file)) {

                $search = "bk";
                $str = fgets($file);
                $resRow = strpos($str, $search);

                if ($resRow !== false) {
                    if (stristr($str, ':', true) !== 'adminbk') {
                        $this->users[] = stristr($str, ':', true);
                    }
                }
            }
            
            fclose($file);
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }

    public function recordData($area, $responsable, $ip, $account, $dir, $lastRecord, $hash, $lastIp, $directories, $deviceDirectorie, $findInfo, $findDirConf, $findUsed) {

        echo "asdasd" . var_dump($this->getUsersToJson()) . "<br>";
        echo (int) $findInfo . "info";
        echo (int) $findDirConf . "dir";
        echo (int) $findUsed . "used";
        echo var_dump($area) . "_1<br>";
        echo var_dump($responsable) . "_2<br>";
        echo var_dump($ip) . "_3<br>";
        echo var_dump($account) . "_4<br>";
        echo var_dump($dir) . "_5<br>";
        echo var_dump($lastRecord) . "_6<br>";
        echo var_dump($hash) . "_7<br>";
        echo var_dump($lastIp) . "_8<br>"; //findinfo
        echo var_dump($directories) . "_9<br>"; //findused
        echo var_dump($deviceDirectorie) . "_10<br><br><hr><br>"; //finddirconf
    }

    public function nextData() {

        $usersJson = array();
        
        foreach ($this->getUsers() as $row) {

            $dataFiles = new DataFiles();
            $dataFiles->setData($row);
            $aux = array("user" => $row);
            $usersJson[] = $aux;
            
            echo $row;
            echo "array: " . var_dump($dataFiles->getDirectories());
            $this->recordData($dataFiles->getFindInfo(), $dataFiles->getFindDirConf(), $dataFiles->getFindUsed(), $dataFiles->getArea(), $dataFiles->getResponsable(), $dataFiles->getIpsync(), $dataFiles->getAccount(), $dataFiles->getDirectory(), $dataFiles->getLastRecord(), $dataFiles->getHash(), $dataFiles->getLastIp(), $dataFiles->getDirectoriesJson(), $dataFiles->getDirConf());
        }
        
        $this->setUsersToJson(ConvertFormats::convertToJsonItems($usersJson));
        
        echo $this->getUsersToJson();
        
    }

}

$loadDataFiles = new CLoadDataFiles();
$loadDataFiles->setDataFilePasswd();
$loadDataFiles->nextData();
?>
