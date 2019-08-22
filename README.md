Json Driver for Cakephp3
========

An Json datasource for CakePHP 3.5

## Installing via composer

Install [composer](http://getcomposer.org) and run:

```bash
composer require giginc/mongodb 1.0.0
```

```php
Plugin::load('Giginc/Json');

```

## Defining a connection
Now, you need to set the connection in your config/app.php file:

```php
 'Datasources' => [
    'default' => [
        'className' => 'Giginc\Json\Database\Connection',
        'driver' => 'Giginc\Json\Database\Driver\Json',
        'path' => './data/file.json', // local path on the server relative to WWW_ROOT
    ],
],
```

## Models
After that, you need to load Giginc\Json\ORM\Table in your tables class:

```php
//src/Model/Table/YourTable.php

use Giginc\Json\ORM\Table;

class CategoriesTable extends Table {

}
```

## SPECIAL THANKS:
[php-jsonq](https://github.com/nahid/jsonq)

## LICENSE

[The MIT License (MIT) Copyright (c) 2013](http://opensource.org/licenses/MIT)
