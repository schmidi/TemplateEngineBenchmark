<?php

class Benchmark {

    protected $memory;
    protected $startTime;
    protected $running;


    public function __construct() {
        $this->memory = 0;
        $this->startTime = 0;
        $this->running = false;
    }


    public function startBenchmark() {

        $this->running = true;
        $this->memory = memory_get_usage();
        $this->startTime = microtime(true);

    }

    public function stopBenchmark() {

        if($this->running)
            return array(
                'time_elapsed' => microtime(true) - $this->startTime,
                "memory_usage" => abs((memory_get_usage() - $this->memory) / 1024)
            );
        else
            throw new BenchmarkException("Benchmark not started");

    }

    public function resetBenchmark() {

        $this->running = false;
        $this->memory = 0;
        $this->startTime = 0;

    }

}

class BenchmarkException extends Exception {
    public function __construct($message) {

        parent::__construct($message);
    }
}