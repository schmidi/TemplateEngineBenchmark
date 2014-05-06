<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . '/RunnerInterface.php');
require_once(FILE_DIR . '/../Libs/Twig-1.15.1/lib/Twig/Autoloader.php');

class TwigRunner extends DataClass implements RunnerInterface {

    public function runTest() {

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(FILE_DIR . "/../Templates");
        $twig = new Twig_Environment($loader, array(
            'cache' => FILE_DIR . "/../Templates/templates_c",
            'auto_reload' => false
        ));


        // load and display template

        $template = $twig->loadTemplate('twigTemplate.html');
        echo $template->render(array(
            'number' => $this->rows,
            'title' => "Twig scenario",
            'table' => $this->data
        ));

    }




}