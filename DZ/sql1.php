<?php 
include "func.php";

$host = 'localhost';
$login = 'root';
$pass = '';
$db_name = 'shop';

$mysql = @new mysqli($host, $login, $pass, $db_name);
if(mysqli_connect_errno()){ die(mysqli_connect_error()); }

$sql = "select * from `category`";
$result = $mysql->query($sql); if (!$result) die($mysql->error);

$data = $result->fetch_all(MYSQLI_ASSOC);
if (count($data)) {
    echo drawTable2($data);
} else {
    echo 'Таблица пустая!';
}

interface ForTable {
    public function create($val1, $val2);
    public function find();
    public function findOne($id);
    public function findBy($a, $b);
    public function update($a, $b, $a1, $b1);
    public function delete($del);
}

class TableOne implements ForTable {
    private $server;
    private $user;
    private $pass;
    private $dbname;



    public function __construct($server,$user,$pass,$dbname)
    {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->openConnection();
    }


    public function openConnection(){
        if(!$this->db)
        {
          $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
            if($connection){
                    mysqli_query($connection, 'SET NAMES UTF8');
                    return true;
                }
                else {
                    return false;
                }
    }
        if (mysqli_connect_errno()) {
             printf("Не удалось подключиться: %s\n", mysqli_connect_error());
             exit();
    }
} 



    public function create($val1, $val2){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
            if (mysqli_connect_errno()) {
                 printf("Не удалось подключиться: %s\n", mysqli_connect_error());
                 exit();
    }
       $insert = "INSERT INTO `category` (title, status) VALUES ('$val1', '$val2')";
        $ins = mysqli_query($connection, $insert, MYSQLI_STORE_RESULT);

             if($ins) {
            return true;
             }
             else
            {
            return false;
             }
    }


    public function find(){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        if(mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s/n", mysqli_connect_error());
            exit();
        }
        $dbFind ="SELECT * FROM category";
        $select = mysqli_query($connection, $dbFind);
        $arr =  mysqli_fetch_all($select, MYSQLI_ASSOC);
        echo "<pre>".print_r($arr, true)."</pre>";
    }


    public function findOne($id){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        if(mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s/n", mysqli_connect_error());
            exit();
        }
        $dbFindOne="SELECT * FROM category WHERE id = $id";
        $select = mysqli_query($connection, $dbFindOne);
        $select1 = mysqli_fetch_all($select, MYSQLI_ASSOC);
        echo "<pre>".print_r($select1, true)."</pre>";
    }



    public function findBy($a, $b){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        if(mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s/n", mysqli_connect_error());
            exit();
        }
        $dbFindBy = "SELECT * FROM category WHERE $a = $b";
        $select = mysqli_query($connection, $dbFindBy);
        $select1 = mysqli_fetch_all($select, MYSQLI_ASSOC);
        echo "<pre>".print_r($select1, true)."</pre>";

    }



    public function update($a, $b, $a1, $b1){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        if(mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s/n", mysqli_connect_error());
            exit();
        }
        $dbUpdate = "UPDATE category SET $a1 = '".$b1."' WHERE $a = $b";
        $select = mysqli_query($connection, $dbUpdate);
        $select1 = mysqli_fetch_all($select);
        echo "<pre>".print_r($select1, true)."</pre>";
    }



    public function delete($del){
         $connection = mysqli_connect($this->$server, $this->user, $this->pass, $this->dbname);
         if(mysqli_connect_errno()){
             printf("Не удалось подключиться:", mysqli_connect_error());
             exit();
         }
         $dbdelete = "DELETE FROM category WHERE  id = $del";
         $select = mysqli_query($connection, $dbdelete);
         $select1  = mysqli_fetch_all($select, MYSQLI_ASSOC);
         echo "<pre>".print_r($select1, true)."</pre>";
    }



    public function close(){
        $connection = mysqli_connect($this->server, $this->user, $this->pass, $this->dbname);
        if (mysqli_connect_errno()) {
           printf("Не удалось подключиться: %s\n", mysqli_connect_error());
           exit();
       }
       return mysqli_close($connection);
    }


}

$first = new TableOne('localhost','root','','shop');
$first->close();

