<?php

declare(strict_types=1);

namespace App;

interface RunnerInterface
{
    public function problemRun(): void;
    public function solutionRun(): void;
}