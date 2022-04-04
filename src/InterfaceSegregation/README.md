## Interface Segregation Principle (ISP)
Definition:
A client should never be forced to implement an interface that it doesn’t use, or clients shouldn’t be forced to depend on methods they do not use.

Problem:
```php
interface PriceInterface
{
    public function getPrice(): float;
    public function getDiscount(): float;
    public function getAdditionalPrice(): float;
}

class SimpleItem implements PriceInterface
{
    public function __construct(private float $price)
    {}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return 0.0;
    }

    public function getAdditionalPrice(): float
    {
        return 0.0;
    }
}

class DiscountItem implements PriceInterface
{
    public function __construct(
        private float $price,
        private float $discount
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getAdditionalPrice(): float
    {
        return 0.0;
    }
}
```

Using:
```php
/** @var PriceInterface[] $items */
$items = [
    'Simple Item:' => new SimpleItem(33.44),
    'Discount Item:' => new DiscountItem(33.44, 0.3),
];

foreach ($items as $key => $item) {
    echo $key.PHP_EOL;
        if($item instanceof SimpleItem){
            echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
        }elseif($item instanceof DiscountItem){
            echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
            echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
        }else{
            echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
            echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
            echo sprintf('AdditionalPrice %01.2f'.PHP_EOL, $item->getAdditionalPrice());
        }
}
```

Run/Output:
```
> php solid_runner ISP

Simple Item:
Price 33.44
Discount Item:
Price 33.44
Discount 0.30
```

Main problem is a interface **PriceInterface**. Some classes which implement this interface have to implement methods which they will not use.
For example, **SimpleItem** implements not used methods **getDiscount()** and **getAdditionalPrice()**. **DiscountItem** implements not used method **getAdditionalPrice()**.


Solution:
```php
interface PriceInterface
{
    public function getPrice(): float;
}

interface DiscountInterface
{
    public function getDiscount(): float;
}

interface AdditionalPriceInterface
{
    public function getAdditionalPrice(): float;
}

class SimpleItem implements PriceInterface
{
    public function __construct(private float $price)
    {}

    public function getPrice(): float
    {
        return $this->price;
    }
}

class DiscountItem implements PriceInterface, DiscountInterface
{
    public function __construct(
        private float $price,
        private float $discount
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
```

Using:
```php
$items = [
    'Simple Item:' => new SimpleItem(33.44),
    'Discount Item:' => new DiscountItem(33.44, 0.3),
];

foreach ($items as $key => $item) {
    echo $key.PHP_EOL;
    if($item instanceof PriceInterface){
        echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
    }
    if($item instanceof DiscountInterface){
        echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
    }
    if($item instanceof AdditionalPriceInterface){
        echo sprintf('AdditionalPrice %01.2f'.PHP_EOL, $item->getAdditionalPrice());
    }
}
```

Run/Output:
```
> php solid_runner ISP

Simple Item:
Price 33.44
Discount Item:
Price 33.44
Discount 0.30
````

We divided **PriceInterface** into several interfaces (**PriceInterface**, **DiscountInterface**, **AdditionalPriceInterface**).
As result - we implemented only the necessary methods