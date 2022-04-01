<?php

declare(strict_types=1);

namespace App\DependencyInversion;

use App\DependencyInversion\Problem\MySQLDataProvider as ProblemMySQLDataProvider;
use App\DependencyInversion\Problem\Order as ProblemOrder;
use App\DependencyInversion\Problem\OrderRepository as ProblemOrderRepository;
use App\DependencyInversion\Solution\MySQLDataProvider as SolutionMySQLDataProvider;
use App\DependencyInversion\Solution\FileDataProvider as SolutionFileDataProvider;
use App\DependencyInversion\Solution\Order as SolutionOrder;
use App\DependencyInversion\Solution\OrderRepository as SolutionOrderRepository;
use App\RunnerInterface;

class Runner implements RunnerInterface
{
    /**
     * MySQLOrderDataProvider is the low-level module while the OrderRepository is high level,
     * but according to the definition of D in SOLID, which states to Depend on abstraction, not on concretions.
     * The case above violates this principle as the OrderRepository class is being forced to depend
     * on the MySQLOrderDataProvider class.
     */
    public function problemRun(): void
    {
        $orderRepository = new ProblemOrderRepository(new ProblemMySQLDataProvider());

        $orderCode = 'order_nr_1';
        $order = new ProblemOrder($orderCode);

        $orderRepository->saveOrder($order);
        $order = $orderRepository->findByCode($orderCode);
    }

    public function solutionRun(): void
    {
        $orderCode = 'order_nr_1';
        $order = new SolutionOrder($orderCode);

        // Managing order by DB
        $orderRepositoryByDB = new SolutionOrderRepository(new SolutionMySQLDataProvider());
        $orderRepositoryByDB->saveOrder($order);
        $order = $orderRepositoryByDB->findByCode($orderCode);

        // Managing order by file
        $orderRepositoryByFile = new SolutionOrderRepository(new SolutionFileDataProvider());
        $orderRepositoryByFile->saveOrder($order);
        $order = $orderRepositoryByFile->findByCode($orderCode);
    }
}