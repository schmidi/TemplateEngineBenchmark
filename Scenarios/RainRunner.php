<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/DataClass.php');
require_once(FILE_DIR . '/../Libs/raintpl3-3.1.0/library/Rain/autoload.php');

use Rain\Tpl;

class RainRunner extends DataClass implements RunnerInterface {


    public function runTest()
    {


        $config = array(
            "tpl_dir"       => FILE_DIR . "/../Templates/",
            "cache_dir"     => FILE_DIR . "/../Templates/cache/",
            "debug"         => false
        );

        Tpl::configure($config);
        Tpl::registerPlugin( new Tpl\Plugin\PathReplace(), "path_replace");

        $tpl = new Tpl;

        $tpl->assign('title', "RainTpl Test");
        $tpl->assign('number', $this->rows);
        $tpl->assign('table', $this->data);

        $tpl->draw("RainTemplate");

        Tpl::removePlugin("path_replace");

    }
}