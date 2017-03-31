<?php
/**
 * Created by PhpStorm.
 * User: sumbrilliance
 * Date: 2017/3/30
 * Time: 下午4:42
 */

class Mysql {
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
    function getAssocArray($sql) {
       $result = self::getInstance()->query($sql);
           return $result -> fetch_assoc();
    }
    function getRow($sql) {
        $result = self::getInstance() -> query($sql);
        return $result -> fetch_row();
    }

    function switchDatabase($dbname) {

    }
}