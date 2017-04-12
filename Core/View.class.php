<?php

/**
 * Created by PhpStorm.
 * User: sumbrilliance
 * Date: 2017/4/12
 * Time: 下午1:37
 */
class View
{
    private $vars = array();
    function __construct()
    {

    }

    public function assign($key, $value) {
        $this -> vars[$key] = $value;

    }
    public function display($file) {
        // 正则匹配 {变量名}
        $pattern = '/\{\s*\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*\}/';
        $replacement = "<?php echo \$this -> vars['\\1']; ?>";
        $originContent = file_get_contents($file);
        $newContent = preg_replace($pattern, $replacement, $originContent);
        file_put_contents($file, $newContent);

        include $file;
    }

}