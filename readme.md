[![Build Status](https://travis-ci.org/harrygr/shipper.svg)](https://travis-ci.org/harrygr/shipper)

# Shipper

Shipper is a php library for shipping methods for an online store. Influenced by Shopify's [active shipping][1] ruby gem it provides a nice extensible api for various shipping methods.

## Installation

With composer installed run `composer install harrygr/shipper` from your project root to add it to your project's dependencies and install the files.

## Usage

__Shipper__ comes with 3 basic calculators:

 - Free shipping
 - Flat rate shipping
 - weight-based shipping

Here we will demonstrate their usage.

For free shipping and flat rate we just set up the calculator and get the rate for an order:

```php
use Harrygr\Shipper\Calculators\FreeShippingCalculator;
use Harrygr\Shipper\Calculators\FlatRateCalculator;

$free_shipping_calculator = new FreeShippingCalculator;
$rate = $free_shipping_calculator->getRate(); // 0

$flat_rate_calculator = new FlatRateCalculator('rate' => 15);
$rate = $flat_rate_calculator->getRate(); // 15
```

Pretty simple eh? OK let's try something more complicated:

```php
use Harrygr\Shipper\Package;
use Harrygr\Shipper\PackageItem;
use Harrygr\Shipper\Weight\Unit;
use Harrygr\Shipper\Weight\Weight;
use Harrygr\Shipper\Calculators\WeightBasedCalculator;


// Package up some items

$package = new Package([
    new PackageItem([
        'weight' => new Weight(2, new Unit('kg'))
    ]),
    new PackageItem([
        'weight' => new Weight(1.5, new Unit('kg'))
    ]),
]);

// Set up a new calculator

$weight_based_calculator = new WeightBasedCalculator([
            'base_rate' => 5,
            'weight_rate' => 2,
            'unit' => 'kg'
            ]);

$rate = $weight_based_calculator->getRate(null, null, $package); // 12
```

## Development

More calculators to come, including those for 3rd party providers (Royal Mail, FedEx etc). These will likely be better suited to their own packages.

All Calculators should implement the `Harrygr\Shipper\Contracts\CalculatorContract` which includes one method `getRate()`.

The package is tested with PHPUnit. Just run `phpunit` to see the test output.

[1]: https://github.com/Shopify/active_shipping