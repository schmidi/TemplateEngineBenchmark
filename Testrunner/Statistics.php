<?php


class Statistics {


    protected $min;
    protected $max;
    protected $average;



    public function __construct(array $data, $index=null) {

        if(!is_array($data)) {
            throw new Exception("Wrong input format");
        }

        $this->generateStatistics($data, $index);

    }

    public function getMin() {
        return $this->min;
    }

    public function getMax() {
        return $this->max;
    }

    public function getAverage() {
        return $this->average;
    }


    private function generateStatistics(array $data, $index=null) {

        $count = count($data);
        $sum = 0;

        for($i=0; $i < $count; $i++) {

            $value = is_null($index) ? $data[$i] : $data[$i][$index];

            if($i==0) {
                $this->min = $this->max = $value;

            } else {

                if($value > $this->max)
                    $this->max = $value;
                if($value < $this->min)
                    $this->min = $value;
            }
            $sum += $value;

        }
        $this->average = $sum / $count;

    }

}
