# REYDEN-X

###### Reyden-X is an automated service for promoting live broadcasts on external sites with integrated system of viewers and views management.

- [Website](https://reyden-x.com/en)

- [API Documentation](https://api.reyden-x.com/docs)

### Installation

```bash
composer require pixel365/reydenx
```

### Quickstart

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use ReydenX\V1\Client;
use ReydenX\V1\Order;

$c = new Client('EMAIL', 'PASSWORD');
$c->auth();

$o = new Order($c);
$details = $o->setOrderId(123456)
    ->details();
var_dump($details);
```

More examples are available under [/examples](https://github.com/pixel365/ReydenX-PHP-SDK/tree/main/examples).
