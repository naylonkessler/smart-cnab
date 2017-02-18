# SmartCNAB

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dc5052cb-a570-40ef-bb75-88ba1bab8c94/mini.png)](https://insight.sensiolabs.com/projects/dc5052cb-a570-40ef-bb75-88ba1bab8c94)
[![Build Status](https://travis-ci.org/naylonkessler/smart-cnab.svg?branch=master)](https://travis-ci.org/naylonkessler/smart-cnab)

## Warning: This package is under active development so breaking changes can accur.

```php
<?php

use SmartCNAB\Services\Factory;
use SmartCNAB\Support\Bank;
use SmartCNAB\Support\File\File;

$factory = new Factory();
$remittance = $factory->remittance(Bank::ITAU, File::CNAB400);
$remittance->begin([]);
$remittance->addDetail([]);
$remittance->end();
$remittance->save($path);
```

```php
<?php

use SmartCNAB\Services\Factory;

$path = '...';

$factory = new Factory();
$return = $factory->returning($path);
$header = $return->header();
$details = $return->details();
$trailer = $return->trailer();
```
