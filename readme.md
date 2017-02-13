# SmartCNAB

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
