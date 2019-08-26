Json Driver for Cakephp3
========

An Json datasource for CakePHP 3.5

## Installing via composer

Install [composer](http://getcomposer.org) and run:

```bash
composer require giginc/cakephp3-driver-json
```

## Defining a connection
Now, you need to set the connection in your config/app.php file:

```php
 'Datasources' => [
    'default' => [
        'className' => 'Giginc\Json\Database\Connection',
        'driver' => 'Giginc\Json\Database\Driver\Json',
        'baseDir' => './', // local path on the server relative to WWW_ROOT
    ],
],
```

## Models
After that, you need to load Giginc\Json\ORM\Table in your tables class:

```php
//src/Model/Table/YourTable.php

use Giginc\Json\ORM\Table;

class CategoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categories'); // load file is WWW_ROOT/categories.json
    }

}
```

## Controllers

```php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('TestJsons');
        $data = $this->TestJsons->find()
            ->where('code', '=', "0001")
            ->get()
            ;
    }
}
```

You can start Query your data using the various query methods such as **find**, **where**, **orWhere**, **whereIn**, **whereStartsWith**, **whereEndsWith**, **whereContains** and so on. Also you can aggregate your data after query using **sum**, **count**, **groupBy**, **max**, **min** etc.

Let's see a quick example:

```json
//data.json
{
	"name": "products",
	"description": "Features product list",
	"vendor":{
		"name": "Computer Source BD",
		"email": "info@example.com",
		"website":"www.example.com"
	},
	"users":[
		{"id":1, "name":"Johura Akter Sumi", "location": "Barisal"},
		{"id":2, "name":"Mehedi Hasan Nahid", "location": "Barisal"},
		{"id":3, "name":"Ariful Islam", "location": "Barisal"},
		{"id":4, "name":"Suhel Ahmed", "location": "Sylhet"},
		{"id":5, "name":"Firoz Serniabat", "location": "Gournodi"},
		{"id":6, "name":"Musa Jewel", "location": "Barisal", "visits": [
			{"name": "Sylhet", "year": 2011},
			{"name": "Cox's Bazar", "year": 2012},
			{"name": "Bandarbar", "year": 2014}
		]}
	],
	"products": [
		{"id":1, "user_id": 2, "city": "bsl", "name":"iPhone", "cat":1, "price": 80000},
		{"id":2, "user_id": 2, "city": null, "name":"macbook pro", "cat": 2, "price": 150000},
		{"id":3, "user_id": 2, "city": "dhk", "name":"Redmi 3S Prime", "cat": 1, "price": 12000},
		{"id":4, "user_id": 1, "city": null, "name":"Redmi 4X", "cat":1, "price": 15000},
		{"id":5, "user_id": 1, "city": "bsl", "name":"macbook air", "cat": 2, "price": 110000},
		{"id":6, "user_id": 2, "city": null, "name":"macbook air 1", "cat": 2, "price": 81000}
	]
}
```

```php
$this->loadModel('TestJsons');
$data = $this->TestJsons->find('products')
    ->where('cat', '=', 2)
    ->get();
dd($res);

//This will print
/*
array:3 [▼
  1 => {#7 ▼
    +"id": 2
    +"user_id": 2
    +"city": null
    +"name": "macbook pro"
    +"cat": 2
    +"price": 150000
  }
  4 => {#8 ▼
    +"id": 5
    +"user_id": 1
    +"city": "bsl"
    +"name": "macbook air"
    +"cat": 2
    +"price": 110000
  }
  5 => {#9 ▼
    +"id": 6
    +"user_id": 2
    +"city": null
    +"name": "macbook air 1"
    +"cat": 2
    +"price": 81000
  }
]
*/
```

## SPECIAL THANKS:
[php-jsonq](https://github.com/nahid/jsonq)

## LICENSE

[The MIT License (MIT) Copyright (c) 2013](http://opensource.org/licenses/MIT)
