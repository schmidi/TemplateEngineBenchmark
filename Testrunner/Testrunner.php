<?php

define('FILE_DIR', dirname(__FILE__));

require_once(FILE_DIR . "/Benchmark.php");
require_once(FILE_DIR . "/Statistics.php");

require(FILE_DIR . "/../Scenarios/SmartyRunner.php");
require(FILE_DIR . "/../Scenarios/TwigRunner.php");
require(FILE_DIR . "/../Scenarios/PearRunner.php");
require(FILE_DIR . "/../Scenarios/RainRunner.php");


function getResults($scenario, $scenario_name, $maxRuns) {

    $b = new Benchmark;

    $results = array();
    $fileOps = array();

    for($i = 0; $i < $maxRuns; $i++) {

        $b->startBenchmark();

        $scenario->runTest();

        $results[] = $b->stopBenchmark();
        $fileOps[] = $scenario->getNumberOfFileOperations();
    }

    $memoryStats = new Statistics($results, "memory_usage");
    $timeStats = new Statistics($results, "time_elapsed");
    $fileOpStats = new Statistics($fileOps);



    // print results
    $output = "\n## Results $scenario_name $maxRuns runs ## \n";
    $output.= "Test: min, avg, max\n";
    $output.= "Memory usage [kB]: ". round($memoryStats->getMin(),3) . ", " .round($memoryStats->getAverage(), 3) . ", " . round($memoryStats->getMax(), 3) . "\n";
    $output.= "Time elapsed [ms]: ". round($timeStats->getMin()*1000, 3) . ", ". round($timeStats->getMin()*1000, 3) . ", " . round($timeStats->getMin()*1000, 3)."\n";
    $output.= "File Operations: ". $fileOpStats->getMin() . ", ". $fileOpStats->getAverage() . ", " . $fileOpStats->getMax()."\n";

    return $output;
}


// Loop over all test classes
function mainLoop() {

    $maxRuns =  20;
    $params = array('rows' => 500);

    $scenarios = array(
        new PearRunner($params),
        new TwigRunner($params),
        //new SmartyRunner($params),
        //new RainRunner($params)
    );

    $results = "";

    foreach($scenarios as $s) {

        $results.= getResults($s, get_class($s), $maxRuns);

    }

    echo $results;

}

// Run all tests
mainLoop();





