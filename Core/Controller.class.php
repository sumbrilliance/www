<?php
/**
 * Created by PhpStorm.
 * User: sumbrilliance
 * Date: 2017/3/27
 * Time: 下午2:21
 */
class Controller {


    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.

        if (!method_exists($this, $name)) {
            throw new \Core\Exception($name.' -->  '.'sorry,not found the method');
        }
    }

    function __construct()
    {
//        $this -> load

    }




}