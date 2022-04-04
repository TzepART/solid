## Open-closed Principle (OCP)
Definition:
Objects or entities should be open for extension but closed for modification.

Problem:
```php
class Item
{
    public function __construct(
        private float $price
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }
}

class ItemWithDiscount
{
    public function __construct(
        private float $price,
        private float $discount = 0.0
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }
}

class PriceCalculator
{
    /**
     * @param Item|ItemWithDiscount[] $items
     */
    public function __construct(private array $items)
    {}

    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            if ($item instanceof ItemWithDiscount) {
                $result += $item->getPrice() * (1 - $item->getDiscount());
            } elseif ($item instanceof Item) {
                $result += $item->getPrice();
            }
        }

        return $result;
    }
}
```

Using:
```php
$items = [
    new Item(33.2),
    new ItemWithDiscount(55.2, 0.3),
    new ItemWithDiscount(133.2, 0.4),
    new Item(3.2),
    new Item(65.56),
];

$priceCalculator = new PriceCalculator($items);
echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());
```

Run/Output:
```
> php solid_runner OCP

Order sum 220.52
```

We have problem with method calculateItemsPrices(). When we will add new class of Item
we will have to add if-section in method calculateItemsPrices(). This's bad.

Solution is adding ResultPriceInterface and using objects which implement this interface in method calculateItemsPrices().

Solution:
```php
interface ResultPriceInterface
{
    public function getResultPrice(): float;
}

class Item implements ResultPriceInterface
{
    public function __construct(
        private float $price
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getResultPrice(): float
    {
        return $this->getPrice();
    }
}

class ItemWithDiscount implements ResultPriceInterface
{
    public function __construct(
        private float $price,
        private float $discount = 0.0
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getResultPrice(): float
    {
        return $this->getPrice() * (1 - $this->getDiscount());
    }
}

class PriceCalculator
{
    /**
     * @param ResultPriceInterface[] $items
     */
    public function __construct(private array $items)
    {}

    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item->getResultPrice();
        }

        return $result;
    }
}
```

Using:
```php
$items = [
    new Item(33.2),
    new ItemWithDiscount(55.2, 0.3),
    new ItemWithDiscount(133.2, 0.4),
    new Item(3.2),
    new Item(65.56),
];

$priceCalculator = new PriceCalculator($items);
echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());
```

Run/Output:
```
> php solid_runner OCP

Order sum 220.52
```