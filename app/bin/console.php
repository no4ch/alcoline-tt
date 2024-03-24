<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Create the Application
$application = new Symfony\Component\Console\Application;

$application->add(new App\VendingMachine\Command\VendingMachineCommand());

// Run it
$application->run();
