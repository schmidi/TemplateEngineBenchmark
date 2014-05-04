<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . "/Benchmark.php");

require(FILE_DIR . "/../Scenarios/SmartyRunner.php");
require(FILE_DIR . "/../Scenarios/TwigRunner.php");
require(FILE_DIR . "/../Scenarios/PearRunner.php");
require(FILE_DIR . "/../Scenarios/RainRunner.php");


function getResults($scenario, $scenario_name, $maxRuns) {

    $b = new Benchmark;

    $results = array();

    for($i = 0; $i < $maxRuns; $i++) {

        $b->startBenchmark();

        $scenario->runTest();

        $results[] = $b->stopBenchmark();
    }

    $maxMemory = 0;
    $minMemory = 0;
    $avgMemory = 0;

    $maxTime = 0;
    $minTime = 0;
    $avgTime = 0;


    // calculate statistical values

    $resultCount = count($results);

    for($i = 0; $i < $resultCount; $i++) {

        $r = $results[$i];



        if($i == 0) {

            $maxMemory = $minMemory = $r['memory_usage'];
            $maxTime = $minTime = $r['time_elapsed'];


        } else {

            if($r['memory_usage'] > $maxMemory)
                $maxMemory = $r['memory_usage'];
            if($r['memory_usage'] < $minMemory)
                $minMemory = $r['memory_usage'];

            if($r['time_elapsed'] > $maxTime)
                $maxTime = $r['time_elapsed'];
            if($r['time_elapsed'] < $minTime)
                $minTime = $r['time_elapsed'];

        }

        $avgTime += $r['time_elapsed'];
        $avgMemory += $r['memory_usage'];

    }

    $avgTime /= $resultCount;
    $avgMemory /= $resultCount;

    // print results
    $output = "\n## Results $scenario_name $maxRuns runs ## \n";
    $output.= "Test: min, avg, max\n";
    $output.= "Memory usage [kB]: ". round($minMemory,3) . ", " .round($avgMemory, 3) . ", " . round($maxMemory, 3) . "\n";
    $output.= "Time elapsed [ms]: ". round($minTime*1000, 3) . ", ". round($avgTime*1000, 3) . ", " . round($maxTime*1000, 3)."\n";

    return $output;
}


// Loop over all test classes
function mainLoop() {

    $maxRuns =  20;
    $params = array('rows' => 20001);

    $scenarios = array(
        new PearRunner($params),
        new SmartyRunner($params),
        new TwigRunner($params),
        new RainRunner($params)
    );

    $results = "";

    foreach($scenarios as $s) {

        $results.= getResults($s, get_class($s), $maxRuns);

    }

    echo $results;

}

// Run all tests
mainLoop();





