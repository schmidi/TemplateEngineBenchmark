<?php


abstract class DataClass {


    protected $params;
    protected $data;
    protected $rows;
    protected $numberOfFileOperations;

    public function __construct($params = null) {

        if(is_null($params))
            $this->params = array();
        else
            $this->params = $params;

        $this->generate_data();
        $this->numberOfFileOperations = 0;

    }

    protected function generate_data() {

        $this->rows = 1000;
        if(array_key_exists('rows', $this->params))
            $this->rows = $this->params['rows'];
        $this->data = array();

        for($i=0; $i < $this->rows; $i ++) {

            $this->data[] = array('id' => $i, 'name' => "name ($i)");
        }


    }

    public function getNumberOfFileOperations() {
        return $this->numberOfFileOperations;
    }


} 