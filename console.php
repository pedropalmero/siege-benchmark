<?php

require_once __DIR__.'/bootstrap.php';

use Symfony\Component\Console\Application;
use SiegeBenchmark\Command\BenchmarkCommand;


$application = new Application();
$application->addCommands(array(
  new BenchmarkCommand()
));
$application->run();