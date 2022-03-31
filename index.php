<?php

declare(strict_types=1);

require 'vendor/autoload.php';

//use App\SingleResponsibility\Runner;
//use App\OpenClosed\Runner;
use App\LiskovSubstitution\Runner;

//'USD'
//'GBP'
//'EUR'

/**
 * Single-responsibility Principle (SRP):
 * A class should have one and only one reason to change, meaning that a class should have only one job.
 */

/**
 * Open-closed Principle (OCP):
 * Objects or entities should be open for extension but closed for modification.
 */

/**
 * Liskov Substitution Principle (LSP):
 * Let q(x) be a property provable about objects of x of type T. Then q(y) should be provable for objects y of type S where S is a subtype of T.
 * This means that every subclass or derived class should be substitutable for their base or parent class.
 */

$runner = new Runner();
$runner->problemRun();
$runner->solutionRun();