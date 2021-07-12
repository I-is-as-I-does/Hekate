<?php

use SSITU\Hekate\Test\TestRunner;

$pathToAutoload = dirname(__DIR__, 4) . '/app/vendor/autoload.php'; # EDIT
require_once $pathToAutoload;

require_once __DIR__ . '/globalScope.php';

$displayException = false;
$htmlDisplay = true;

$TestRunner = new TestRunner($displayException, $htmlDisplay);
$TestRunner->run();
