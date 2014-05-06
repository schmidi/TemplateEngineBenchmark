<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/DataClass.php');
require_once(FILE_DIR . '/../Libs/HTML_Template_IT-1.3.0/HTML/Template/IT.php');

class PearRunner extends DataClass implements RunnerInterface {


    public function runTest() {

        $engine = new HTML_Template_IT(FILE_DIR . "/../Templates");

        $engine->loadTemplatefile('pearTemplate.tpl');


        $engine->setVariable('TITLE', "PEAR Test");
        $engine->setVariable('NUMBER', $this->rows);

        foreach($this->data as $value) {

            foreach($value as $cell) {
                $engine->setCurrentBlock('cell');
                $engine->setVariable('ENTRY', $cell);
                $engine->parseCurrentBlock();
            }

            $engine->setCurrentBlock('row');
            $engine->parseCurrentBlock();
        }

        $engine->show();

    }



}