
<?php


function dbAction() {
    $db_host = "localhost";
    $db_user = "root";
    $db_pwd = "1111";







//function tellMe() {
//    var_dump($_GET);
//}

//    $link = mysql_connect($db_host, $db_user, $db_pwd);
    $link = new mysqli($db_host, $db_user, $db_pwd) or die("unable connect to mysql!");

    echo date("y-d-m H:i:s");
//    if (mysql_error($link)) {
//        echo "连接失败!";
//    }

    if ($link -> connect_error) {
        echo "connect failed!";
    }


    if (!mysqli_select_db($link, "DB")) {
        echo "selected db failed!";
    }

    $sql_create_table = "CREATE TABLE if NOT EXISTS DB2(
        id INT NOT NULL AUTO_INCREMENT,
        sex enum('男' , '女'),
        PRIMARY KEY (id));";


//    $sql_imitate_data = "";

    $ret = mysqli_query($link , $sql_create_table);
    if (!$ret) {
        echo "create table failed!";
    }

    $sql_insert_data = "INSERT INTO DB2 (sex) VALUES ('男')";

    if (!mysqli_query($link , $sql_insert_data)) {

        echo "can't insert";
    }

    $sql_insert_data1 = "INSERT INTO DB2 (sex) VALUES ('女');";

    if (!mysqli_query($link , $sql_insert_data1)) {

        echo "can't insert2";
    }
    $sql_alert = "ALTER TABLE DB2 ADD name VARCHAR(255) AFTER sex";
    if (!mysqli_query($link, $sql_alert)) {

        echo "alter failed!";
    }
}




class mysql {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pwd = "1111";
    private $db_name = "DB";
    private $link;

    static $_instance;

     function __construct() {

         $this ->link =  new mysqli($this ->db_host, $this ->db_user, $this -> db_pwd) or die("无法连接到数据库!");

         if ($this ->link -> connect_error){
             echo "connect failed!";
         }
        if (!mysqli_select_db($this ->link, $this -> db_name)){
            echo "select db failed!";
        }
         mysqli_set_charset($this ->link , "utf8");

         return $this ->link;
     }


    public static function getInstance ()
     {
         if ((self::$_instance instanceof self) == FAlSE){
             self::$_instance = new self();
         }
         return self::$_instance;
     }
    function query($sql) {
       $result = mysqli_query($this->link, $sql);
        return $result;
    }



}

?>



