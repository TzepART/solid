## Dependency Inversion Principle (DIP)
Definition:
1. High-level modules should not depend on low-level modules. Both should depend on the abstraction.
2. Abstractions should not depend on details. Details should depend on abstractions.

Problem:
```php
class Order
{
    public function __construct(private string $code)
    {}

    public function getCode(): string
    {
        return $this->code;
    }
}

class MySQLDataProvider
{

    public function __construct()
    {
        // There is connection to DB
    }

    public function save(mixed $object): void
    {
        // save Order to DB
    }

    public function findByField(string $field, string $value): mixed
    {
        return null;
    }
}

class OrderRepository
{
    public function __construct(private MySQLDataProvider $orderDataProvider)
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
```

Using:
```php
$orderRepository = new OrderRepository(new MySQLDataProvider());

$orderCode = 'order_nr_1';
$order = new Order($orderCode);

$orderRepository->saveOrder($order);
$order = $orderRepository->findByCode($orderCode);
```

Run/Output:
```
> php solid_runner DIP
```

MySQLOrderDataProvider is the low-level module while the OrderRepository is high level, but according to the definition of D in SOLID, which states to depend on abstraction, not on concretions.
The case above violates this principle as the OrderRepository class is being forced to depend on the MySQLOrderDataProvider class.

Solution is adding an abstraction (DataProviderInterface), then details (DataProviders, OrderRepository) will depend on abstraction (DataProviderInterface).

Solution:
```php
class Order
{
    public function __construct(private string $code)
    {}

    public function getCode(): string
    {
        return $this->code;
    }
}

interface DataProviderInterface
{
    public function save(mixed $object): void;
    public function findByField(string $field, string $value): mixed;
}

class FileDataProvider implements DataProviderInterface
{
    public function __construct()
    {
        // There is connection to DB
    }

    public function save(mixed $object): void
    {
        // save Order to DB
    }

    public function findByField(string $field, string $value): mixed
    {
        return null;
    }
}

class MySQLDataProvider implements DataProviderInterface
{

    public function __construct()
    {
        // There is connection to DB
    }

    public function save(mixed $object): void
    {
        // save Order to DB
    }

    public function findByField(string $field, string $value): mixed
    {
        return null;
    }
}

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
```

Using:
```php
$orderCode = 'order_nr_1';
$order = new Order($orderCode);

// Managing order by DB
$orderRepositoryByDB = new OrderRepository(new MySQLDataProvider());
$orderRepositoryByDB->saveOrder($order);
$order = $orderRepositoryByDB->findByCode($orderCode);

// Managing order by file
$orderRepositoryByFile = new OrderRepository(new FileDataProvider());
$orderRepositoryByFile->saveOrder($order);
$order = $orderRepositoryByFile->findByCode($orderCode);
```

Run/Output:
```
> php solid_runner DIP
```