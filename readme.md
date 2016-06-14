# SmartCNAB

```php
<?php

$factory = new \SmartCNAB\Factory();
$remittance = $factory->remittance(\SmartCNAB\Support\Bank::ITAU, \SmartCNAB\Support\File\File::CNAB400);
$remittance->begin([]);
$remittance->addDetail([]);
$remittance->end();
$remittance->save($path);
```

```php
<?php

$factory = new \SmartCNAB\Factory();
$return = $factory->returning($path);
$return->getHeader();
$return->getDetails();
$return->getFooter();
```