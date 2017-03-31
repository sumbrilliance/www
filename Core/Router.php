<?php
/**
 * Created by PhpStorm.
 * User: sumbrilliance
 * Date: 2017/3/27
 * Time: 下午12:01
 */
require CORE_PATH.'Controller.class.php';    // 必须引用,否则为了找到这个类,会再次调用autoload方法
class Router {


    public static function run() {
        spl_autoload_register("self::autoload");
        self::dispatch();
    }

    private static function dispatch() {

        if (!isset($_SERVER['PATH_INFO'])) {
            echo "显示主页内容";

        }
        $path_info = $_SERVER['PATH_INFO'];
        $paths = explode('/', $path_info);

        if (empty($paths[1])) {
            echo "路径为空";
            exit();
        }

        $controller = ucfirst($paths[1])."Controller";
        $method = $paths[2];
        $filename = CONTROLLER_PATH.$controller.'.class.php';


        if (!is_file($filename)) {
            echo "not found the pages";
        }
        $ctr = new $controller();

        $param = array();
        if (false !== strpos($_SERVER['REQUEST_URI'],'?')) { // 参数以传统方式传过来, 如xx.com/ctr/method?arg0=0&arg1=1
                $component = parse_url($_SERVER['REQUEST_URI']);
                var_dump($component);
                parse_str($component['query'], $param);
        }else {
                $param = array_splice($paths, 3); // 截取掉域名,控制器,函数,剩下作为参数
        }

        $ctr -> $method($param);

    }

   private static function autoload($className) {

        require CONTROLLER_PATH.$className.'.class.php';

    }

}

