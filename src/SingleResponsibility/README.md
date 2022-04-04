## Single-responsibility Principle (SRP)

Problem:
```php
class Item
{
    public function __construct(private float $price)
    {}

    public function getPrice(): float
    {
        return $this->price;
    }
}

class PriceCalculator
{
    /**
     * @param Item[] $items
     */
    public function __construct(private array $items)
    {}

    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item->getPrice();
        }

        return $result;
    }

    public function getFormattedPrices(): array
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = sprintf('%01.2f USD', $item->getPrice());
        }

        return $result;
    }
}
```

Using:
```php
$items = [
    new Item(33.2),
    new Item(55.2),
    new Item(133.2),
    new Item(3.2),
    new Item(65.56),
];

$priceCalculator = new BadPriceCalculator($items);
echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());

foreach ($priceCalculator->getFormattedPrices() as $i => $formattedPrice) {
    echo sprintf('Item #%d - %s'.PHP_EOL, $i, $formattedPrice);
}
```

Run:
```
php solid_runner SRP
```

Output
```
Order sum 290.36
Item #0 - 33.20 USD
Item #1 - 55.20 USD
Item #2 - 133.20 USD
Item #3 - 3.20 USD
Item #4 - 65.56 USD
```