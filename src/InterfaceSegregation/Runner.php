<?php

declare(strict_types=1);

namespace App\InterfaceSegregation;

use App\InterfaceSegregation\Problem\DiscountItem as ProblemDiscountItem;
use App\InterfaceSegregation\Problem\SimpleItem as ProblemSimpleItem;
use App\InterfaceSegregation\Problem\PriceInterface as ProblemPriceInterface;
use App\InterfaceSegregation\Solution\DiscountItem as SolutionDiscountItem;
use App\InterfaceSegregation\Solution\SimpleItem as SolutionSimpleItem;
use App\InterfaceSegregation\Solution\PriceInterface as SolutionPriceInterface;
use App\InterfaceSegregation\Solution\DiscountInterface as SolutionDiscountInterface;
use App\InterfaceSegregation\Solution\AdditionalPriceInterface as SolutionAdditionalPriceInterface;
use App\RunnerInterface;

class Runner implements RunnerInterface
{
    public function problemRun(): void
    {
        /** @var ProblemPriceInterface[] $items */
        $items = [
            'Simple Item:' => new ProblemSimpleItem(33.44),
            'Discount Item:' => new ProblemDiscountItem(33.44, 0.3),
        ];

        /**
         * Main problem is a interface ProblemPriceInterface. Some classes which implement this interface have to implement
         * methods which they will not use. For example, ProblemSimpleItem implements not used methods getDiscount() and getAdditionalPrice().
         * ProblemDiscountItem implements not used method getAdditionalPrice().
         */
        foreach ($items as $key => $item) {
            echo $key.PHP_EOL;
                if($item instanceof ProblemSimpleItem){
                    echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
                }elseif($item instanceof ProblemDiscountItem){
                    echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
                    echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
                }else{
                    echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
                    echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
                    echo sprintf('AdditionalPrice %01.2f'.PHP_EOL, $item->getAdditionalPrice());
                }
        }
    }

    public function solutionRun(): void
    {
        $items = [
            'Simple Item:' => new SolutionSimpleItem(33.44),
            'Discount Item:' => new SolutionDiscountItem(33.44, 0.3),
        ];

        /**
         * We divided ProblemPriceInterface into several interfaces (SolutionPriceInterface, SolutionDiscountInterface, SolutionAdditionalPriceInterface).
         * As result - we implemented only the necessary methods
         */
        foreach ($items as $key => $item) {
            echo $key.PHP_EOL;
            if($item instanceof SolutionPriceInterface){
                echo sprintf('Price %01.2f'.PHP_EOL, $item->getPrice());
            }
            if($item instanceof SolutionDiscountInterface){
                echo sprintf('Discount %01.2f'.PHP_EOL, $item->getDiscount());
            }
            if($item instanceof SolutionAdditionalPriceInterface){
                echo sprintf('AdditionalPrice %01.2f'.PHP_EOL, $item->getAdditionalPrice());
            }
        }
    }
}