<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/DataClass.php');
require_once(FILE_DIR . '/../Libs/Smarty-3.1.17/libs/Smarty.class.php');


class SmartyRunner extends DataClass implements RunnerInterface {


    public function runTest() {

        $smarty = new Smarty;
        $smarty->caching = false;

        $smarty->setTemplateDir(FILE_DIR . '/../Templates');
        $smarty->setCompileDir(FILE_DIR . '/../Templates/templates_c');
        $smarty->setCacheDir(FILE_DIR . '/../Templates/cache');
        $smarty->setConfigDir(FILE_DIR . '/../Templates/config');

        $smarty->assign('table', $this->data);
        $smarty->assign('number', $this->rows);
        $smarty->assign('title', "Smarty Test");


        $smarty->display('smartyTemplate.tpl');





    }

}
