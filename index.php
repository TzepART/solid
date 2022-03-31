<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\SingleResponsibility\Runner;

//'USD'
//'GBP'
//'EUR'

$runner = new Runner();
$runner->problemRun();
$runner->solutionRun();