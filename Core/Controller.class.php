<?php
/**
 * Created by PhpStorm.
 * User: sumbrilliance
 * Date: 2017/3/27
 * Time: 下午2:21
 */
include CORE_PATH.'View.class.php';
class Controller {

    private $view = null;

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.

        if (!method_exists($this, $name)) {
            throw new \Core\Exception($name.' -->  '.'sorry,not found the method');
        }
    }

    function __construct()
    {
        $this -> view = new View();
    }

    public function display($name) {


        $this ->view -> display($name);
    }

    public function assign($key, $value) {

        $this->view -> assign($key, $value);
    }



}