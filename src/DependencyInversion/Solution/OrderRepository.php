<?php

declare(strict_types=1);

namespace App\DependencyInversion\Solution;

class OrderRepository
{
    public function __construct(private DataProviderInterface $orderDataProvider)
    {}

    public function saveOrder(Order $order): void
    {
        $this->orderDataProvider->save($order);
    }

    public function findByCode(string $code):? Order
    {
        return $this->orderDataProvider->findByField('code', $code);
    }
}