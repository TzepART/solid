## Liskov Substitution Principle (LSP)
Definition:
This principle means that every subclass or derived class should be substitutable for their base or parent class.

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
}

class PriceCalculatorWithDiscount extends PriceCalculator
{
    private float $discount = 0.0;

    public function calculateItemsPrices(): float
    {
        return parent::calculateItemsPrices() * (1 - $this->getDiscount());
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }
}
```

Using:
```php
$items = [
    new Item(33.2),
    new Item(3.2),
    new Item(65.56),
];
$discount = 0.2;

$calculators = [
    'Simple calculator' => new PriceCalculator($items),
    'Calculator with discount' => (new PriceCalculatorWithDiscount($items))->setDiscount($discount),
];

// ... some layer of business logic

foreach ($calculators as $calculator) {
    if($calculator instanceof PriceCalculator){
        echo sprintf('Calculation without discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
    }

    if ($calculator instanceof PriceCalculatorWithDiscount){
        echo sprintf('Calculation with discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
    }
}
```

Run/Output:
```
> php solid_runner LSP

Calculation without discount. Order sum 101.96
Calculation without discount. Order sum 81.57
Calculation with discount. Order sum 81.57
```

Because we have an object instanceof of simple **PriceCalculator** we'll expect that method **calculateItemsPrices()** will return price without discount. But output:
```
Calculation without discount. Order sum 101.96
Calculation without discount. Order sum 81.57 // Error here!!!
Calculation with discount. Order sum 81.57
```

Because **PriceCalculatorWithDiscount** violates the Liskov Substitution principle. We can't use an object of class **PriceCalculatorWithDiscount** instead object of class **PriceCalculator**

Solution - add method **calculateItemsPricesWithDiscount()**, which will not rewrite **calculateItemsPrices()**

Solution:
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
}

class PriceCalculatorWithDiscount extends PriceCalculator
{
    private float $discount = 0.0;

    public function calculateItemsPricesWithDiscount(): float
    {
        return parent::calculateItemsPrices() * (1 - $this->getDiscount());
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }
}
```

Using:
```php
$items = [
    new Item(33.2),
    new Item(3.2),
    new Item(65.56),
];
$discount = 0.2;

$calculators = [
    'Simple calculator' => new PriceCalculator($items),
    'Calculator with discount' => (new PriceCalculatorWithDiscount($items))->setDiscount($discount),
];

// ... some layer of business logic

foreach ($calculators as $calculator) {
    if($calculator instanceof PriceCalculator){
        echo sprintf('Calculation without discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
    }

    if ($calculator instanceof PriceCalculatorWithDiscount){
        echo sprintf('Calculation with discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPricesWithDiscount());
    }
}
```

Run/Output:
```
> php solid_runner LSP

Calculation without discount. Order sum 101.96
Calculation without discount. Order sum 101.96
Calculation with discount. Order sum 81.57
```

Then output:
```
Calculation without discount. Order sum 101.96
Calculation without discount. Order sum 101.96 // Everything is FINE!!!
Calculation with discount. Order sum 81.57
```