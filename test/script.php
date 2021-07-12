<?php
/* This file is part of Hekate | SSITU | (c) 2021 I-is-as-I-does | MIT License */

use SSITU\Hekate\Test\TestRunner;

$pathToAutoload = dirname(__DIR__, 3) . '/app/vendor/autoload.php'; # EDIT
require_once $pathToAutoload;

require_once __DIR__ . '/globalScope.php';

$displayException = false;
$htmlDisplay = true;

$TestRunner = new TestRunner($displayException, $htmlDisplay);
$TestRunner->run();
