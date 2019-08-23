Collections
===========

inspired by: https://github.com/tightenco/collect

documents: https://laravel.com/docs/5.8/collections

Installation
------------
```sh
$ composer require geniv/nette-collection
```
or
```json
"geniv/nette-collection": "^1.0"
```

require:
```json
"php": ">=7.0"
```

- [Introduction](#introduction)
- [Creating Collections](#creating-collections)
- [Available Methods](#available-methods)
- [Method Listing](#method-listing)
- [Higher Order Messages](#higher-order-messages)

<a name="introduction"></a>
## Introduction

The `Collection\Collection` class provides a fluent, convenient wrapper for working with arrays of data. For example, check out the following code. We'll use the `collect` helper to create a new collection instance from the array, run the `strtoupper` function on each element, and then remove all empty elements:

    $collection = Collection::make(['taylor', 'abigail', null])->map(function ($name) {
        return strtoupper($name);
    })
    ->reject(function ($name) {
        return empty($name);
    });


As you can see, the `Collection` class allows you to chain its methods to perform fluent mapping and reducing of the underlying array. In general, every `Collection` method returns an entirely new `Collection` instance.

<a name="creating-collections"></a>
## Creating Collections

As mentioned above, the `collect` helper returns a new `Collection\Collection` instance for the given array. So, creating a collection is as simple as:

    $collection = Collection::make([1, 2, 3]);

<a name="available-methods"></a>
## Available Methods

    use Collection\Collection;

For the remainder of this documentation, we'll discuss each method available on the `Collection` class. Remember, all of these methods may be chained for fluently manipulating the underlying array. Furthermore, almost every method returns a new `Collection` instance, allowing you to preserve the original copy of the collection when necessary.

You may select any method from this table to see an example of its usage:

| Method | ... | ... |
|---|---|---|
| [all](#method-all) | [isNotEmpty](#method-isNotEmpty) | [slice](#method-slice)
| [average](#method-average) | [join](#method-join) | [some](#method-some)
| [avg](#method-avg) | [keyBy](#method-keyBy) | [sort](#method-sort)
| [chunk](#method-chunk) | [keys](#method-keys) | [sortBy](#method-sortBy)
| [collapse](#method-collapse) | [last](#method-last) | [sortByDesc](#method-sortByDesc)
| [combine](#method-combine) | [macro](#method-macro) | [sortKeys](#method-sortKeys)
| [concat](#method-concat) | [make](#method-make) | [sortKeysDesc](#method-sortKeysDesc)
| [contains](#method-contains) | [map](#method-map) | [splice](#method-splice)
| [containsStrict](#method-containsStrict) | [mapInto](#method-mapInto) | [split](#method-split)
| [count](#method-count) | [mapSpread](#method-mapSpread) | [sum](#method-sum)
| [countBy](#method-countBy) | [mapToGroups](#method-mapToGroups) | [take](#method-take)
| [crossJoin](#method-crossJoin) | [mapWithKeys](#method-mapWithKeys) | [tap](#method-tap)
| [dd](#method-dd) | [max](#method-max) | [times](#method-times)
| [diff](#method-diff) | [median](#method-median) | [toArray](#method-toArray)
| [diffAssoc](#method-diffAssoc) | [merge](#method-merge) | [toJson](#method-toJson)
| [diffKeys](#method-diffKeys) | [mergeRecursive](#method-mergeRecursive) | [transform](#method-transform)
| [dump](#method-dump) | [min](#method-min) | [union](#method-union)
| [duplicates](#method-duplicates) | [mode](#method-mode) | [unique](#method-unique)
| [duplicatesStrict](#method-duplicatesStrict) | [nth](#method-nth) | [uniqueStrict](#method-uniqueStrict)
| [each](#method-each) | [only](#method-only) | [unless](#method-unless)
| [eachSpread](#method-eachSpread) | [pad](#method-pad) | [unlessEmpty](#method-unlessEmpty)
| [every](#method-every) | [partition](#method-partition) | [unlessNotEmpty](#method-unlessNotEmpty)
| [except](#method-except) | [pipe](#method-pipe) | [unwrap](#method-unwrap)
| [filter](#method-filter) | [pluck](#method-pluck) | [values](#method-values)
| [first](#method-first) | [pop](#method-pop) | [when](#method-when)
| [firstWhere](#method-firstWhere) | [prepend](#method-prepend) | [whenEmpty](#method-whenEmpty)
| [flatMap](#method-flatMap) | [pull](#method-pull) | [whenNotEmpty](#method-whenNotEmpty)
| [flatten](#method-flatten) | [push](#method-push) | [where](#method-where)
| [flip](#method-flip) | [put](#method-put) | [whereStrict](#method-whereStrict)
| [forget](#method-forget) | [random](#method-random) | [whereBetween](#method-whereBetween)
| [forPage](#method-forPage) | [reduce](#method-reduce) | [whereIn](#method-whereIn)
| [get](#method-get) | [reject](#method-reject) | [whereInStrict](#method-whereInStrict)
| [groupBy](#method-groupBy) | [replace](#method-replace) | [whereInstanceOf](#method-whereInstanceOf)
| [has](#method-has) | [replaceRecursive](#method-replaceRecursive) | [whereNotBetween](#method-whereNotBetween)
| [implode](#method-implode) | [reverse](#method-reverse) | [whereNotIn](#method-whereNotIn)
| [intersect](#method-intersect) | [search](#method-search) | [whereNotInStrict](#method-whereNotInStrict)
| [intersectByKeys](#method-intersectByKeys) | [shift](#method-shift) | [wrap](#method-wrap)
| [isEmpty](#method-isEmpty) | [shuffle](#method-shuffle) | [zip](#method-zip)

<a name="method-listing"></a>
## Method Listing

<a name="method-all"></a>
#### `all()`
The all method returns the underlying array represented by the collection:

    Collection::make([1, 2, 3])->all();

    // [1, 2, 3]

<a name="method-avg"></a>
#### `average()`
Alias for the [avg](#method-avg) method.

<a name="method-avg"></a>
#### `avg()`
The avg method returns the average value of a given key:

    $average = Collection::make([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');

    // 20

    $average = Collection::make([1, 1, 2, 4])->avg();

    // 2

<a name="method-chunk"></a>
#### `chunk()`
The chunk method breaks the collection into multiple, smaller collections of a given size:

    $collection = Collection::make([1, 2, 3, 4, 5, 6, 7]);

    $chunks = $collection->chunk(4);

    $chunks->toArray();

    // [[1, 2, 3, 4], [5, 6, 7]]
This method is especially useful in views when working with a grid system such as Bootstrap. Imagine you have a collection of Eloquent models you want to display in a grid:

    @foreach ($products->chunk(3) as $chunk)
        <div class="row">
            @foreach ($chunk as $product)
                <div class="col-xs-4">{{ $product->name }}</div>
            @endforeach
        </div>
    @endforeach

<a name="method-collapse"></a>
#### `collapse()`
The collapse method collapses a collection of arrays into a single, flat collection:

    $collection = Collection::make([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

    $collapsed = $collection->collapse();

    $collapsed->all();

    // [1, 2, 3, 4, 5, 6, 7, 8, 9]

<a name="method-combine"></a>
#### `combine()`
The combine method combines the values of the collection, as keys, with the values of another array or collection:

    $collection = Collection::make(['name', 'age']);

    $combined = $collection->combine(['George', 29]);

    $combined->all();

    // ['name' => 'George', 'age' => 29]

<a name="method-concat"></a>
#### `concat()`
The concat method appends the given array or collection values onto the end of the collection:

    $collection = Collection::make(['John Doe']);

    $concatenated = $collection->concat(['Jane Doe'])->concat(['name' => 'Johnny Doe']);

    $concatenated->all();

    // ['John Doe', 'Jane Doe', 'Johnny Doe']

<a name="method-contains"></a>
#### `contains()`
The contains method determines whether the collection contains a given item:

    $collection = Collection::make(['name' => 'Desk', 'price' => 100]);

    $collection->contains('Desk');

    // true

    $collection->contains('New York');

    // false
You may also pass a key / value pair to the contains method, which will determine if the given pair exists in the collection:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 100],
    ]);

    $collection->contains('product', 'Bookcase');

    // false
Finally, you may also pass a callback to the contains method to perform your own truth test:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->contains(function ($value, $key) {
        return $value > 5;
    });

    // false
The contains method uses "loose" comparisons when checking item values, meaning a string with an integer value will be considered equal to an integer of the same value. Use the containsStrict method to filter using "strict" comparisons.


<a name="method-containsStrict"></a>
#### `containsStrict()`
This method has the same signature as the contains method; however, all values are compared using "strict" comparisons.


<a name="method-count"></a>
#### `count()`
The count method returns the total number of items in the collection:

    $collection = Collection::make([1, 2, 3, 4]);

    $collection->count();

    // 4

<a name="method-countBy"></a>
#### `countBy()`
The countBy method counts the occurrences of values in the collection. By default, the method counts the occurrences of every element:

    $collection = Collection::make([1, 2, 2, 2, 3]);

    $counted = $collection->countBy();

    $counted->all();

    // [1 => 1, 2 => 3, 3 => 1]
However, you pass a callback to the countBy method to count all items by a custom value:

    $collection = Collection::make(['alice@gmail.com', 'bob@yahoo.com', 'carlos@gmail.com']);

    $counted = $collection->countBy(function ($email) {
        return substr(strrchr($email, "@"), 1);
    });

    $counted->all();

    // ['gmail.com' => 2, 'yahoo.com' => 1]

<a name="method-crossJoin"></a>
#### `crossJoin()`
The crossJoin method cross joins the collection's values among the given arrays or collections, returning a Cartesian product with all possible permutations:

    $collection = Collection::make([1, 2]);

    $matrix = $collection->crossJoin(['a', 'b']);

    $matrix->all();

    /*
        [
            [1, 'a'],
            [1, 'b'],
            [2, 'a'],
            [2, 'b'],
        ]
    */

    $collection = Collection::make([1, 2]);

    $matrix = $collection->crossJoin(['a', 'b'], ['I', 'II']);

    $matrix->all();

    /*
        [
            [1, 'a', 'I'],
            [1, 'a', 'II'],
            [1, 'b', 'I'],
            [1, 'b', 'II'],
            [2, 'a', 'I'],
            [2, 'a', 'II'],
            [2, 'b', 'I'],
            [2, 'b', 'II'],
        ]
    */

<a name="method-dd"></a>
#### `dd()`
The dd method dumps the collection's items and ends execution of the script:

    $collection = Collection::make(['John Doe', 'Jane Doe']);

    $collection->dd();

    /*
        Collection {
            #items: array:2 [
                0 => "John Doe"
                1 => "Jane Doe"
            ]
        }
    */
If you do not want to stop executing the script, use the dump method instead.


<a name="method-diff"></a>
#### `diff()`
The diff method compares the collection against another collection or a plain PHP  array based on its values. This method will return the values in the original collection that are not present in the given collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $diff = $collection->diff([2, 4, 6, 8]);

    $diff->all();

    // [1, 3, 5]

<a name="method-diffAssoc"></a>
#### `diffAssoc()`
The diffAssoc method compares the collection against another collection or a plain PHP array based on its keys and values. This method will return the key / value pairs in the original collection that are not present in the given collection:

    $collection = Collection::make([
        'color' => 'orange',
        'type' => 'fruit',
        'remain' => 6
    ]);

    $diff = $collection->diffAssoc([
        'color' => 'yellow',
        'type' => 'fruit',
        'remain' => 3,
        'used' => 6
    ]);

    $diff->all();

    // ['color' => 'orange', 'remain' => 6]

<a name="method-diffKeys"></a>
#### `diffKeys()`
The diffKeys method compares the collection against another collection or a plain PHP array based on its keys. This method will return the key / value pairs in the original collection that are not present in the given collection:

    $collection = Collection::make([
        'one' => 10,
        'two' => 20,
        'three' => 30,
        'four' => 40,
        'five' => 50,
    ]);

    $diff = $collection->diffKeys([
        'two' => 2,
        'four' => 4,
        'six' => 6,
        'eight' => 8,
    ]);

    $diff->all();

    // ['one' => 10, 'three' => 30, 'five' => 50]

<a name="method-dump"></a>
#### `dump()`
The dump method dumps the collection's items:

    $collection = Collection::make(['John Doe', 'Jane Doe']);

    $collection->dump();

    /*
        Collection {
            #items: array:2 [
                0 => "John Doe"
                1 => "Jane Doe"
            ]
        }
    */
If you want to stop executing the script after dumping the collection, use the dd method instead.


<a name="method-duplicates"></a>
#### `duplicates()`
The duplicates method retrieves and returns duplicate values from the collection:

    $collection = Collection::make(['a', 'b', 'a', 'c', 'b']);

    $collection->duplicates();

    // [2 => 'a', 4 => 'b']
If the collection contains arrays or objects, you can pass the key of the attributes that you wish to check for duplicate values:

    $employees = Collection::make([
        ['email' => 'abigail@example.com', 'position' => 'Developer'],
        ['email' => 'james@example.com', 'position' => 'Designer'],
        ['email' => 'victoria@example.com', 'position' => 'Developer'],
    ])

    $employees->duplicates('position');

    // [2 => 'Developer']

<a name="method-duplicatesStrict"></a>
#### `duplicatesStrict()`
This method has the same signature as the duplicates method; however, all values are compared using "strict" comparisons.


<a name="method-each"></a>
#### `each()`
The each method iterates over the items in the collection and passes each item to a callback:

    $collection->each(function ($item, $key) {
        //
    });
If you would like to stop iterating through the items, you may return false from your callback:

    $collection->each(function ($item, $key) {
        if (/* some condition */) {
            return false;
        }
    });

<a name="method-eachSpread"></a>
#### `eachSpread()`
The eachSpread method iterates over the collection's items, passing each nested item value into the given callback:

    $collection = Collection::make([['John Doe', 35], ['Jane Doe', 33]]);

    $collection->eachSpread(function ($name, $age) {
        //
    });
You may stop iterating through the items by returning false from the callback:

    $collection->eachSpread(function ($name, $age) {
        return false;
    });

<a name="method-every"></a>
#### `every()`
The every method may be used to verify that all elements of a collection pass a given truth test:

    Collection::make([1, 2, 3, 4])->every(function ($value, $key) {
        return $value > 2;
    });

    // false
If the collection is empty, every will return true:

    $collection = Collection::make([]);

    $collection->every(function($value, $key) {
        return $value > 2;
    });

    // true

<a name="method-except"></a>
#### `except()`
The except method returns all items in the collection except for those with the specified keys:

    $collection = Collection::make(['product_id' => 1, 'price' => 100, 'discount' => false]);

    $filtered = $collection->except(['price', 'discount']);

    $filtered->all();

    // ['product_id' => 1]
For the inverse of except, see the only method.


<a name="method-filter"></a>
#### `filter()`
The filter method filters the collection using the given callback, keeping only those items that pass a given truth test:

    $collection = Collection::make([1, 2, 3, 4]);

    $filtered = $collection->filter(function ($value, $key) {
        return $value > 2;
    });

    $filtered->all();

    // [3, 4]
If no callback is supplied, all entries of the collection that are equivalent to false will be removed:

    $collection = Collection::make([1, 2, 3, null, false, '', 0, []]);

    $collection->filter()->all();

    // [1, 2, 3]
For the inverse of filter, see the reject method.


<a name="method-first"></a>
#### `first()`
The first method returns the first element in the collection that passes a given truth test:

    Collection::make([1, 2, 3, 4])->first(function ($value, $key) {
        return $value > 2;
    });

    // 3
You may also call the first method with no arguments to get the first element in the collection. If the collection is empty, null is returned:

    Collection::make([1, 2, 3, 4])->first();

    // 1

<a name="method-firstWhere"></a>
#### `firstWhere()`
The firstWhere method returns the first element in the collection with the given key / value pair:

    $collection = Collection::make([
        ['name' => 'Regena', 'age' => null],
        ['name' => 'Linda', 'age' => 14],
        ['name' => 'Diego', 'age' => 23],
        ['name' => 'Linda', 'age' => 84],
    ]);

    $collection->firstWhere('name', 'Linda');

    // ['name' => 'Linda', 'age' => 14]
You may also call the firstWhere method with an operator:

    $collection->firstWhere('age', '>=', 18);

    // ['name' => 'Diego', 'age' => 23]
Like the where method, you may pass one argument to the firstWhere method. In this scenario, the firstWhere method will return the first item where the given item key's value is "truthy":

    $collection->firstWhere('age');

    // ['name' => 'Linda', 'age' => 14]

<a name="method-flatMap"></a>
#### `flatMap()`
The flatMap method iterates through the collection and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items. Then, the array is flattened by a level:

    $collection = Collection::make([
        ['name' => 'Sally'],
        ['school' => 'Arkansas'],
        ['age' => 28]
    ]);

    $flattened = $collection->flatMap(function ($values) {
        return array_map('strtoupper', $values);
    });

    $flattened->all();

    // ['name' => 'SALLY', 'school' => 'ARKANSAS', 'age' => '28'];

<a name="method-flatten"></a>
#### `flatten()`
The flatten method flattens a multi-dimensional collection into a single dimension:

    $collection = Collection::make(['name' => 'taylor', 'languages' => ['php', 'javascript']]);

    $flattened = $collection->flatten();

    $flattened->all();

    // ['taylor', 'php', 'javascript'];
You may optionally pass the function a "depth" argument:

    $collection = Collection::make([
        'Apple' => [
            ['name' => 'iPhone 6S', 'brand' => 'Apple'],
        ],
        'Samsung' => [
            ['name' => 'Galaxy S7', 'brand' => 'Samsung']
        ],
    ]);

    $products = $collection->flatten(1);

    $products->values()->all();

    /*
        [
            ['name' => 'iPhone 6S', 'brand' => 'Apple'],
            ['name' => 'Galaxy S7', 'brand' => 'Samsung'],
        ]
    */
In this example, calling flatten without providing the depth would have also flattened the nested arrays, resulting in  ['iPhone 6S', 'Apple', 'Galaxy S7', 'Samsung']. Providing a depth allows you to restrict the levels of nested arrays that will be flattened.


<a name="method-flip"></a>
#### `flip()`
The flip method swaps the collection's keys with their corresponding values:

    $collection = Collection::make(['name' => 'taylor', 'framework' => 'laravel']);

    $flipped = $collection->flip();

    $flipped->all();

    // ['taylor' => 'name', 'laravel' => 'framework']

<a name="method-forget"></a>
#### `forget()`
The forget method removes an item from the collection by its key:

    $collection = Collection::make(['name' => 'taylor', 'framework' => 'laravel']);

    $collection->forget('name');

    $collection->all();

    // ['framework' => 'laravel']

Unlike most other collection methods, forget does not return a new modified collection; it modifies the collection it is called on.


<a name="method-forPage"></a>
#### `forPage()`
The forPage method returns a new collection containing the items that would be present on a given page number. The method accepts the page number as its first argument and the number of items to show per page as its second argument:

    $collection = Collection::make([1, 2, 3, 4, 5, 6, 7, 8, 9]);

    $chunk = $collection->forPage(2, 3);

    $chunk->all();

    // [4, 5, 6]

<a name="method-get"></a>
#### `get()`
The get method returns the item at a given key. If the key does not exist, null is returned:

    $collection = Collection::make(['name' => 'taylor', 'framework' => 'laravel']);

    $value = $collection->get('name');

    // taylor
You may optionally pass a default value as the second argument:

    $collection = Collection::make(['name' => 'taylor', 'framework' => 'laravel']);

    $value = $collection->get('foo', 'default-value');

    // default-value
You may even pass a callback as the default value. The result of the callback will be returned if the specified key does not exist:

    $collection->get('email', function () {
        return 'default-value';
    });

    // default-value

<a name="method-groupBy"></a>
#### `groupBy()`
The groupBy method groups the collection's items by a given key:

    $collection = Collection::make([
        ['account_id' => 'account-x10', 'product' => 'Chair'],
        ['account_id' => 'account-x10', 'product' => 'Bookcase'],
        ['account_id' => 'account-x11', 'product' => 'Desk'],
    ]);

    $grouped = $collection->groupBy('account_id');

    $grouped->toArray();

    /*
        [
            'account-x10' => [
                ['account_id' => 'account-x10', 'product' => 'Chair'],
                ['account_id' => 'account-x10', 'product' => 'Bookcase'],
            ],
            'account-x11' => [
                ['account_id' => 'account-x11', 'product' => 'Desk'],
            ],
        ]
    */
Instead of passing a string key, you may pass a callback. The callback should return the value you wish to key the group by:

    $grouped = $collection->groupBy(function ($item, $key) {
        return substr($item['account_id'], -3);
    });

    $grouped->toArray();

    /*
        [
            'x10' => [
                ['account_id' => 'account-x10', 'product' => 'Chair'],
                ['account_id' => 'account-x10', 'product' => 'Bookcase'],
            ],
            'x11' => [
                ['account_id' => 'account-x11', 'product' => 'Desk'],
            ],
        ]
    */
Multiple grouping criteria may be passed as an array. Each array element will be applied to the corresponding level within a multi-dimensional array:

    $data = new Collection([
        10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
        20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
        30 => ['user' => 3, 'skill' => 2, 'roles' => ['Role_1']],
        40 => ['user' => 4, 'skill' => 2, 'roles' => ['Role_2']],
    ]);

    $result = $data->groupBy([
        'skill',
        function ($item) {
            return $item['roles'];
        },
    ], $preserveKeys = true);

    /*
    [
        1 => [
            'Role_1' => [
                10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
                20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
            ],
            'Role_2' => [
                20 => ['user' => 2, 'skill' => 1, 'roles' => ['Role_1', 'Role_2']],
            ],
            'Role_3' => [
                10 => ['user' => 1, 'skill' => 1, 'roles' => ['Role_1', 'Role_3']],
            ],
        ],
        2 => [
            'Role_1' => [
                30 => ['user' => 3, 'skill' => 2, 'roles' => ['Role_1']],
            ],
            'Role_2' => [
                40 => ['user' => 4, 'skill' => 2, 'roles' => ['Role_2']],
            ],
        ],
    ];
    */

<a name="method-has"></a>
#### `has()`
The has method determines if a given key exists in the collection:

    $collection = Collection::make(['account_id' => 1, 'product' => 'Desk', 'amount' => 5]);

    $collection->has('product');

    // true

    $collection->has(['product', 'amount']);

    // true

    $collection->has(['amount', 'price']);

    // false

<a name="method-implode"></a>
#### `implode()`
The implode method joins the items in a collection. Its arguments depend on the type of items in the collection. If the collection contains arrays or objects, you should pass the key of the attributes you wish to join, and the "glue" string you wish to place between the values:

    $collection = Collection::make([
        ['account_id' => 1, 'product' => 'Desk'],
        ['account_id' => 2, 'product' => 'Chair'],
    ]);

    $collection->implode('product', ', ');

    // Desk, Chair
If the collection contains simple strings or numeric values, pass the "glue" as the only argument to the method:

    Collection::make([1, 2, 3, 4, 5])->implode('-');

    // '1-2-3-4-5'

<a name="method-intersect"></a>
#### `intersect()`
The intersect method removes any values from the original collection that are not present in the given array or collection. The resulting collection will preserve the original collection's keys:

    $collection = Collection::make(['Desk', 'Sofa', 'Chair']);

    $intersect = $collection->intersect(['Desk', 'Chair', 'Bookcase']);

    $intersect->all();

    // [0 => 'Desk', 2 => 'Chair']

<a name="method-intersectByKeys"></a>
#### `intersectByKeys()`
The intersectByKeys method removes any keys from the original collection that are not present in the given array or collection:

    $collection = Collection::make([
        'serial' => 'UX301', 'type' => 'screen', 'year' => 2009
    ]);

    $intersect = $collection->intersectByKeys([
        'reference' => 'UX404', 'type' => 'tab', 'year' => 2011
    ]);

    $intersect->all();

    // ['type' => 'screen', 'year' => 2009]

<a name="method-isEmpty"></a>
#### `isEmpty()`
The isEmpty method returns true if the collection is empty; otherwise, false is returned:

    Collection::make([])->isEmpty();

    // true

<a name="method-isNotEmpty"></a>
#### `isNotEmpty()`
The isNotEmpty method returns true if the collection is not empty; otherwise, false is returned:

    Collection::make([])->isNotEmpty();

    // false

<a name="method-join"></a>
#### `join()`
The join method joins the collection's values with a string:

    Collection::make(['a', 'b', 'c'])->join(', '); // 'a, b, c'
    Collection::make(['a', 'b', 'c'])->join(', ', ', and '); // 'a, b, and c'
    Collection::make(['a', 'b'])->join(', ', ' and '); // 'a and b'
    Collection::make(['a'])->join(', ', ' and '); // 'a'
    Collection::make([])->join(', ', ' and '); // ''

<a name="method-keyBy"></a>
#### `keyBy()`
The keyBy method keys the collection by the given key. If multiple items have the same key, only the last one will appear in the new collection:

    $collection = Collection::make([
        ['product_id' => 'prod-100', 'name' => 'Desk'],
        ['product_id' => 'prod-200', 'name' => 'Chair'],
    ]);

    $keyed = $collection->keyBy('product_id');

    $keyed->all();

    /*
        [
            'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
            'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]
    */
You may also pass a callback to the method. The callback should return the value to key the collection by:

    $keyed = $collection->keyBy(function ($item) {
        return strtoupper($item['product_id']);
    });

    $keyed->all();

    /*
        [
            'PROD-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
            'PROD-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
        ]
    */

<a name="method-keys"></a>
#### `keys()`
The keys method returns all of the collection's keys:

    $collection = Collection::make([
        'prod-100' => ['product_id' => 'prod-100', 'name' => 'Desk'],
        'prod-200' => ['product_id' => 'prod-200', 'name' => 'Chair'],
    ]);

    $keys = $collection->keys();

    $keys->all();

    // ['prod-100', 'prod-200']

<a name="method-last"></a>
#### `last()`
The last method returns the last element in the collection that passes a given truth test:

    Collection::make([1, 2, 3, 4])->last(function ($value, $key) {
        return $value < 3;
    });

    // 2
You may also call the last method with no arguments to get the last element in the collection. If the collection is empty, null is returned:

    Collection::make([1, 2, 3, 4])->last();

    // 4

<a name="method-macro"></a>
#### `macro()`
The static macro method allows you to add methods to the Collection class at run time. Refer to the documentation on extending collections for more information.


<a name="method-make"></a>
#### `make()`
The static make method creates a new collection instance. See the Creating Collections section.


<a name="method-map"></a>
#### `map()`
The map method iterates through the collection and passes each value to the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $multiplied = $collection->map(function ($item, $key) {
        return $item * 2;
    });

    $multiplied->all();

    // [2, 4, 6, 8, 10]

Like most other collection methods, map returns a new collection instance; it does not modify the collection it is called on. If you want to transform the original collection, use the transform method.


<a name="method-mapInto"></a>
#### `mapInto()`
The mapInto() method iterates over the collection, creating a new instance of the given class by passing the value into the constructor:

    class Currency
    {
        /**
         * Create a new currency instance.
         *
         * @param  string  $code
         * @return void
         */
        function __construct(string $code)
        {
            $this->code = $code;
        }
    }

    $collection = Collection::make(['USD', 'EUR', 'GBP']);

    $currencies = $collection->mapInto(Currency::class);

    $currencies->all();

    // [Currency('USD'), Currency('EUR'), Currency('GBP')]

<a name="method-mapSpread"></a>
#### `mapSpread()`
The mapSpread method iterates over the collection's items, passing each nested item value into the given callback. The callback is free to modify the item and return it, thus forming a new collection of modified items:

    $collection = Collection::make([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

    $chunks = $collection->chunk(2);

    $sequence = $chunks->mapSpread(function ($even, $odd) {
        return $even + $odd;
    });

    $sequence->all();

    // [1, 5, 9, 13, 17]

<a name="method-mapToGroups"></a>
#### `mapToGroups()`
The mapToGroups method groups the collection's items by the given callback. The callback should return an associative array containing a single key / value pair, thus forming a new collection of grouped values:

    $collection = Collection::make([
        [
            'name' => 'John Doe',
            'department' => 'Sales',
        ],
        [
            'name' => 'Jane Doe',
            'department' => 'Sales',
        ],
        [
            'name' => 'Johnny Doe',
            'department' => 'Marketing',
        ]
    ]);

    $grouped = $collection->mapToGroups(function ($item, $key) {
        return [$item['department'] => $item['name']];
    });

    $grouped->toArray();

    /*
        [
            'Sales' => ['John Doe', 'Jane Doe'],
            'Marketing' => ['Johnny Doe'],
        ]
    */

    $grouped->get('Sales')->all();

    // ['John Doe', 'Jane Doe']

<a name="method-mapWithKeys"></a>
#### `mapWithKeys()`
The mapWithKeys method iterates through the collection and passes each value to the given callback. The callback should return an associative array containing a single key / value pair:

    $collection = Collection::make([
        [
            'name' => 'John',
            'department' => 'Sales',
            'email' => 'john@example.com'
        ],
        [
            'name' => 'Jane',
            'department' => 'Marketing',
            'email' => 'jane@example.com'
        ]
    ]);

    $keyed = $collection->mapWithKeys(function ($item) {
        return [$item['email'] => $item['name']];
    });

    $keyed->all();

    /*
        [
            'john@example.com' => 'John',
            'jane@example.com' => 'Jane',
        ]
    */

<a name="method-max"></a>
#### `max()`
The max method returns the maximum value of a given key:

    $max = Collection::make([['foo' => 10], ['foo' => 20]])->max('foo');

    // 20

    $max = Collection::make([1, 2, 3, 4, 5])->max();

    // 5

<a name="method-median"></a>
#### `median()`
The median method returns the median value of a given key:

    $median = Collection::make([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->median('foo');

    // 15

    $median = Collection::make([1, 1, 2, 4])->median();

    // 1.5

<a name="method-merge"></a>
#### `merge()`
The merge method merges the given array or collection with the original collection. If a string key in the given items matches a string key in the original collection, the given items's value will overwrite the value in the original collection:

    $collection = Collection::make(['product_id' => 1, 'price' => 100]);

    $merged = $collection->merge(['price' => 200, 'discount' => false]);

    $merged->all();

    // ['product_id' => 1, 'price' => 200, 'discount' => false]
If the given items's keys are numeric, the values will be appended to the end of the collection:

    $collection = Collection::make(['Desk', 'Chair']);

    $merged = $collection->merge(['Bookcase', 'Door']);

    $merged->all();

    // ['Desk', 'Chair', 'Bookcase', 'Door']

<a name="method-mergeRecursive"></a>
#### `mergeRecursive()`
The mergeRecursive method merges the given array or collection recursively with the original collection. If a string key in the given items matches a string key in the original collection, then the values for these keys are merged together into an array, and this is done recursively:

    $collection = Collection::make(['product_id' => 1, 'price' => 100]);

    $merged = $collection->mergeRecursive(['product_id' => 2, 'price' => 200, 'discount' => false]);

    $merged->all();

    // ['product_id' => [1, 2], 'price' => [100, 200], 'discount' => false]

<a name="method-min"></a>
#### `min()`
The min method returns the minimum value of a given key:

    $min = Collection::make([['foo' => 10], ['foo' => 20]])->min('foo');

    // 10

    $min = Collection::make([1, 2, 3, 4, 5])->min();

    // 1

<a name="method-mode"></a>
#### `mode()`
The mode method returns the mode value of a given key:

    $mode = Collection::make([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->mode('foo');

    // [10]

    $mode = Collection::make([1, 1, 2, 4])->mode();

    // [1]

<a name="method-nth"></a>
#### `nth()`
The nth method creates a new collection consisting of every n-th element:

    $collection = Collection::make(['a', 'b', 'c', 'd', 'e', 'f']);

    $collection->nth(4);

    // ['a', 'e']
You may optionally pass an offset as the second argument:

    $collection->nth(4, 1);

    // ['b', 'f']

<a name="method-only"></a>
#### `only()`
The only method returns the items in the collection with the specified keys:

    $collection = Collection::make(['product_id' => 1, 'name' => 'Desk', 'price' => 100, 'discount' => false]);

    $filtered = $collection->only(['product_id', 'name']);

    $filtered->all();

    // ['product_id' => 1, 'name' => 'Desk']
For the inverse of only, see the except method.


<a name="method-pad"></a>
#### `pad()`
The pad method will fill the array with the given value until the array reaches the specified size. This method behaves like the array_pad PHP function.

To pad to the left, you should specify a negative size. No padding will take place if the absolute value of the given size is less than or equal to the length of the array:

    $collection = Collection::make(['A', 'B', 'C']);

    $filtered = $collection->pad(5, 0);

    $filtered->all();

    // ['A', 'B', 'C', 0, 0]

    $filtered = $collection->pad(-5, 0);

    $filtered->all();

    // [0, 0, 'A', 'B', 'C']

<a name="method-partition"></a>
#### `partition()`
The partition method may be combined with the list PHP function to separate elements that pass a given truth test from those that do not:

    $collection = Collection::make([1, 2, 3, 4, 5, 6]);

    list($underThree, $equalOrAboveThree) = $collection->partition(function ($i) {
        return $i < 3;
    });

    $underThree->all();

    // [1, 2]

    $equalOrAboveThree->all();

    // [3, 4, 5, 6]

<a name="method-pipe"></a>
#### `pipe()`
The pipe method passes the collection to the given callback and returns the result:

    $collection = Collection::make([1, 2, 3]);

    $piped = $collection->pipe(function ($collection) {
        return $collection->sum();
    });

    // 6

<a name="method-pluck"></a>
#### `pluck()`
The pluck method retrieves all of the values for a given key:

    $collection = Collection::make([
        ['product_id' => 'prod-100', 'name' => 'Desk'],
        ['product_id' => 'prod-200', 'name' => 'Chair'],
    ]);

    $plucked = $collection->pluck('name');

    $plucked->all();

    // ['Desk', 'Chair']
You may also specify how you wish the resulting collection to be keyed:

    $plucked = $collection->pluck('name', 'product_id');

    $plucked->all();

    // ['prod-100' => 'Desk', 'prod-200' => 'Chair']
If duplicate keys exist, the last matching element will be inserted into the plucked collection:

    $collection = Collection::make([
        ['brand' => 'Tesla',  'color' => 'red'],
        ['brand' => 'Pagani', 'color' => 'white'],
        ['brand' => 'Tesla',  'color' => 'black'],
        ['brand' => 'Pagani', 'color' => 'orange'],
    ]);

    $plucked = $collection->pluck('color', 'brand');

    $plucked->all();

    // ['Tesla' => 'black', 'Pagani' => 'orange']

<a name="method-pop"></a>
#### `pop()`
The pop method removes and returns the last item from the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->pop();

    // 5

    $collection->all();

    // [1, 2, 3, 4]

<a name="method-prepend"></a>
#### `prepend()`
The prepend method adds an item to the beginning of the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->prepend(0);

    $collection->all();

    // [0, 1, 2, 3, 4, 5]
You may also pass a second argument to set the key of the prepended item:

    $collection = Collection::make(['one' => 1, 'two' => 2]);

    $collection->prepend(0, 'zero');

    $collection->all();

    // ['zero' => 0, 'one' => 1, 'two' => 2]

<a name="method-pull"></a>
#### `pull()`
The pull method removes and returns an item from the collection by its key:

    $collection = Collection::make(['product_id' => 'prod-100', 'name' => 'Desk']);

    $collection->pull('name');

    // 'Desk'

    $collection->all();

    // ['product_id' => 'prod-100']

<a name="method-push"></a>
#### `push()`
The push method appends an item to the end of the collection:

    $collection = Collection::make([1, 2, 3, 4]);

    $collection->push(5);

    $collection->all();

    // [1, 2, 3, 4, 5]

<a name="method-put"></a>
#### `put()`
The put method sets the given key and value in the collection:

    $collection = Collection::make(['product_id' => 1, 'name' => 'Desk']);

    $collection->put('price', 100);

    $collection->all();

    // ['product_id' => 1, 'name' => 'Desk', 'price' => 100]

<a name="method-random"></a>
#### `random()`
The random method returns a random item from the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->random();

    // 4 - (retrieved randomly)
You may optionally pass an integer to random to specify how many items you would like to randomly retrieve. A collection of items is always returned when explicitly passing the number of items you wish to receive:

    $random = $collection->random(3);

    $random->all();

    // [2, 4, 5] - (retrieved randomly)
If the Collection has fewer items than requested, the method will throw an  InvalidArgumentException.


<a name="method-reduce"></a>
#### `reduce()`
The reduce method reduces the collection to a single value, passing the result of each iteration into the subsequent iteration:

    $collection = Collection::make([1, 2, 3]);

    $total = $collection->reduce(function ($carry, $item) {
        return $carry + $item;
    });

    // 6
The value for $carry on the first iteration is null; however, you may specify its initial value by passing a second argument to reduce:

    $collection->reduce(function ($carry, $item) {
        return $carry + $item;
    }, 4);

    // 10

<a name="method-reject"></a>
#### `reject()`
The reject method filters the collection using the given callback. The callback should return true if the item should be removed from the resulting collection:

    $collection = Collection::make([1, 2, 3, 4]);

    $filtered = $collection->reject(function ($value, $key) {
        return $value > 2;
    });

    $filtered->all();

    // [1, 2]
For the inverse of the reject method, see the filter method.


<a name="method-replace"></a>
#### `replace()`
The replace method behaves similarly to merge; however, in addition to overwriting matching items with string keys, the replace method will also overwrite items in the collection that have matching numeric keys:

    $collection = Collection::make(['Taylor', 'Abigail', 'James']);

    $replaced = $collection->replace([1 => 'Victoria', 3 => 'Finn']);

    $replaced->all();

    // ['Taylor', 'Victoria', 'James', 'Finn']

<a name="method-replaceRecursive"></a>
#### `replaceRecursive()`
This method works like replace, but it will recurse into arrays and apply the same replacement process to the inner values:

    $collection = Collection::make(['Taylor', 'Abigail', ['James', 'Victoria', 'Finn']]);

    $replaced = $collection->replaceRecursive(['Charlie', 2 => [1 => 'King']]);

    $replaced->all();

    // ['Charlie', 'Abigail', ['James', 'King', 'Finn']]

<a name="method-reverse"></a>
#### `reverse()`
The reverse method reverses the order of the collection's items, preserving the original keys:

    $collection = Collection::make(['a', 'b', 'c', 'd', 'e']);

    $reversed = $collection->reverse();

    $reversed->all();

    /*
        [
            4 => 'e',
            3 => 'd',
            2 => 'c',
            1 => 'b',
            0 => 'a',
        ]
    */

<a name="method-search"></a>
#### `search()`
The search method searches the collection for the given value and returns its key if found. If the item is not found, false is returned.

    $collection = Collection::make([2, 4, 6, 8]);

    $collection->search(4);

    // 1
The search is done using a "loose" comparison, meaning a string with an integer value will be considered equal to an integer of the same value. To use "strict" comparison, pass true as the second argument to the method:

    $collection->search('4', true);

    // false
Alternatively, you may pass in your own callback to search for the first item that passes your truth test:

    $collection->search(function ($item, $key) {
        return $item > 5;
    });

    // 2

<a name="method-shift"></a>
#### `shift()`
The shift method removes and returns the first item from the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->shift();

    // 1

    $collection->all();

    // [2, 3, 4, 5]

<a name="method-shuffle"></a>
#### `shuffle()`
The shuffle method randomly shuffles the items in the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $shuffled = $collection->shuffle();

    $shuffled->all();

    // [3, 2, 5, 1, 4] - (generated randomly)

<a name="method-slice"></a>
#### `slice()`
The slice method returns a slice of the collection starting at the given index:

    $collection = Collection::make([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

    $slice = $collection->slice(4);

    $slice->all();

    // [5, 6, 7, 8, 9, 10]
If you would like to limit the size of the returned slice, pass the desired size as the second argument to the method:

    $slice = $collection->slice(4, 2);

    $slice->all();

    // [5, 6]
The returned slice will preserve keys by default. If you do not wish to preserve the original keys, you can use the values method to reindex them.


<a name="method-some"></a>
#### `some()`
Alias for the contains method.


<a name="method-sort"></a>
#### `sort()`
The sort method sorts the collection. The sorted collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:

    $collection = Collection::make([5, 3, 1, 2, 4]);

    $sorted = $collection->sort();

    $sorted->values()->all();

    // [1, 2, 3, 4, 5]
If your sorting needs are more advanced, you may pass a callback to sort with your own algorithm. Refer to the PHP documentation on uasort, which is what the collection's sort method calls under the hood.


If you need to sort a collection of nested arrays or objects, see the sortBy and sortByDesc methods.


<a name="method-sortBy"></a>
#### `sortBy()`
The sortBy method sorts the collection by the given key. The sorted collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:

    $collection = Collection::make([
        ['name' => 'Desk', 'price' => 200],
        ['name' => 'Chair', 'price' => 100],
        ['name' => 'Bookcase', 'price' => 150],
    ]);

    $sorted = $collection->sortBy('price');

    $sorted->values()->all();

    /*
        [
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
            ['name' => 'Desk', 'price' => 200],
        ]
    */
You can also pass your own callback to determine how to sort the collection values:

    $collection = Collection::make([
        ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
        ['name' => 'Chair', 'colors' => ['Black']],
        ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
    ]);

    $sorted = $collection->sortBy(function ($product, $key) {
        return count($product['colors']);
    });

    $sorted->values()->all();

    /*
        [
            ['name' => 'Chair', 'colors' => ['Black']],
            ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
            ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
        ]
    */

<a name="method-sortByDesc"></a>
#### `sortByDesc()`
This method has the same signature as the sortBy method, but will sort the collection in the opposite order.


<a name="method-sortKeys"></a>
#### `sortKeys()`
The sortKeys method sorts the collection by the keys of the underlying associative array:

    $collection = Collection::make([
        'id' => 22345,
        'first' => 'John',
        'last' => 'Doe',
    ]);

    $sorted = $collection->sortKeys();

    $sorted->all();

    /*
        [
            'first' => 'John',
            'id' => 22345,
            'last' => 'Doe',
        ]
    */

<a name="method-sortKeysDesc"></a>
#### `sortKeysDesc()`
This method has the same signature as the sortKeys method, but will sort the collection in the opposite order.


<a name="method-splice"></a>
#### `splice()`
The splice method removes and returns a slice of items starting at the specified index:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $chunk = $collection->splice(2);

    $chunk->all();

    // [3, 4, 5]

    $collection->all();

    // [1, 2]
You may pass a second argument to limit the size of the resulting chunk:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $chunk = $collection->splice(2, 1);

    $chunk->all();

    // [3]

    $collection->all();

    // [1, 2, 4, 5]
In addition, you can pass a third argument containing the new items to replace the items removed from the collection:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $chunk = $collection->splice(2, 1, [10, 11]);

    $chunk->all();

    // [3]

    $collection->all();

    // [1, 2, 10, 11, 4, 5]

<a name="method-split"></a>
#### `split()`
The split method breaks a collection into the given number of groups:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $groups = $collection->split(3);

    $groups->toArray();

    // [[1, 2], [3, 4], [5]]

<a name="method-sum"></a>
#### `sum()`
The sum method returns the sum of all items in the collection:

    Collection::make([1, 2, 3, 4, 5])->sum();

    // 15
If the collection contains nested arrays or objects, you should pass a key to use for determining which values to sum:

    $collection = Collection::make([
        ['name' => 'JavaScript: The Good Parts', 'pages' => 176],
        ['name' => 'JavaScript: The Definitive Guide', 'pages' => 1096],
    ]);

    $collection->sum('pages');

    // 1272
In addition, you may pass your own callback to determine which values of the collection to sum:

    $collection = Collection::make([
        ['name' => 'Chair', 'colors' => ['Black']],
        ['name' => 'Desk', 'colors' => ['Black', 'Mahogany']],
        ['name' => 'Bookcase', 'colors' => ['Red', 'Beige', 'Brown']],
    ]);

    $collection->sum(function ($product) {
        return count($product['colors']);
    });

    // 6

<a name="method-take"></a>
#### `take()`
The take method returns a new collection with the specified number of items:

    $collection = Collection::make([0, 1, 2, 3, 4, 5]);

    $chunk = $collection->take(3);

    $chunk->all();

    // [0, 1, 2]
You may also pass a negative integer to take the specified amount of items from the end of the collection:

    $collection = Collection::make([0, 1, 2, 3, 4, 5]);

    $chunk = $collection->take(-2);

    $chunk->all();

    // [4, 5]

<a name="method-tap"></a>
#### `tap()`
The tap method passes the collection to the given callback, allowing you to "tap" into the collection at a specific point and do something with the items while not affecting the collection itself:

    Collection::make([2, 4, 3, 1, 5])
        ->sort()
        ->tap(function ($collection) {
            Log::debug('Values after sorting', $collection->values()->toArray());
        })
        ->shift();

    // 1

<a name="method-times"></a>
#### `times()`
The static times method creates a new collection by invoking the callback a given amount of times:

    $collection = Collection::times(10, function ($number) {
        return $number * 9;
    });

    $collection->all();

    // [9, 18, 27, 36, 45, 54, 63, 72, 81, 90]
This method can be useful when combined with factories to create Eloquent models:

    $categories = Collection::times(3, function ($number) {
        return factory(Category::class)->create(['name' => "Category No. $number"]);
    });

    $categories->all();

    /*
        [
            ['id' => 1, 'name' => 'Category #1'],
            ['id' => 2, 'name' => 'Category #2'],
            ['id' => 3, 'name' => 'Category #3'],
        ]
    */

<a name="method-toArray"></a>
#### `toArray()`
The toArray method converts the collection into a plain PHP array. If the collection's values are Eloquent models, the models will also be converted to arrays:

    $collection = Collection::make(['name' => 'Desk', 'price' => 200]);

    $collection->toArray();

    /*
        [
            ['name' => 'Desk', 'price' => 200],
        ]
    */

toArray also converts all of the collection's nested objects that are an instance of Arrayable to an array. If you want to get the raw underlying array, use the all method instead.


<a name="method-toJson"></a>
#### `toJson()`
The toJson method converts the collection into a JSON serialized string:

    $collection = Collection::make(['name' => 'Desk', 'price' => 200]);

    $collection->toJson();

    // '{"name":"Desk", "price":200}'

<a name="method-transform"></a>
#### `transform()`
The transform method iterates over the collection and calls the given callback with each item in the collection. The items in the collection will be replaced by the values returned by the callback:

    $collection = Collection::make([1, 2, 3, 4, 5]);

    $collection->transform(function ($item, $key) {
        return $item * 2;
    });

    $collection->all();

    // [2, 4, 6, 8, 10]

Unlike most other collection methods, transform modifies the collection itself. If you wish to create a new collection instead, use the map method.


<a name="method-union"></a>
#### `union()`
The union method adds the given array to the collection. If the given array contains keys that are already in the original collection, the original collection's values will be preferred:

    $collection = Collection::make([1 => ['a'], 2 => ['b']]);

    $union = $collection->union([3 => ['c'], 1 => ['b']]);

    $union->all();

    // [1 => ['a'], 2 => ['b'], 3 => ['c']]

<a name="method-unique"></a>
#### `unique()`
The unique method returns all of the unique items in the collection. The returned collection keeps the original array keys, so in this example we'll use the values method to reset the keys to consecutively numbered indexes:

    $collection = Collection::make([1, 1, 2, 2, 3, 4, 2]);

    $unique = $collection->unique();

    $unique->values()->all();

    // [1, 2, 3, 4]
When dealing with nested arrays or objects, you may specify the key used to determine uniqueness:

    $collection = Collection::make([
        ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
        ['name' => 'iPhone 5', 'brand' => 'Apple', 'type' => 'phone'],
        ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
        ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
        ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
    ]);

    $unique = $collection->unique('brand');

    $unique->values()->all();

    /*
        [
            ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
            ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
        ]
    */
You may also pass your own callback to determine item uniqueness:

    $unique = $collection->unique(function ($item) {
        return $item['brand'].$item['type'];
    });

    $unique->values()->all();

    /*
        [
            ['name' => 'iPhone 6', 'brand' => 'Apple', 'type' => 'phone'],
            ['name' => 'Apple Watch', 'brand' => 'Apple', 'type' => 'watch'],
            ['name' => 'Galaxy S6', 'brand' => 'Samsung', 'type' => 'phone'],
            ['name' => 'Galaxy Gear', 'brand' => 'Samsung', 'type' => 'watch'],
        ]
    */
The unique method uses "loose" comparisons when checking item values, meaning a string with an integer value will be considered equal to an integer of the same value. Use the uniqueStrict method to filter using "strict" comparisons.


<a name="method-uniqueStrict"></a>
#### `uniqueStrict()`
This method has the same signature as the unique method; however, all values are compared using "strict" comparisons.


<a name="method-unless"></a>
#### `unless()`
The unless method will execute the given callback unless the first argument given to the method evaluates to true:

    $collection = Collection::make([1, 2, 3]);

    $collection->unless(true, function ($collection) {
        return $collection->push(4);
    });

    $collection->unless(false, function ($collection) {
        return $collection->push(5);
    });

    $collection->all();

    // [1, 2, 3, 5]
For the inverse of unless, see the when method.


<a name="method-unlessEmpty"></a>
#### `unlessEmpty()`
Alias for the whenNotEmpty method.


<a name="method-unlessNotEmpty"></a>
#### `unlessNotEmpty()`
Alias for the whenEmpty method.


<a name="method-unwrap"></a>
#### `unwrap()`
The static unwrap method returns the collection's underlying items from the given value when applicable:

    Collection::unwrap(Collection::make('John Doe'));

    // ['John Doe']

    Collection::unwrap(['John Doe']);

    // ['John Doe']

    Collection::unwrap('John Doe');

    // 'John Doe'

<a name="method-values"></a>
#### `values()`
The values method returns a new collection with the keys reset to consecutive integers:

    $collection = Collection::make([
        10 => ['product' => 'Desk', 'price' => 200],
        11 => ['product' => 'Desk', 'price' => 200]
    ]);

    $values = $collection->values();

    $values->all();

    /*
        [
            0 => ['product' => 'Desk', 'price' => 200],
            1 => ['product' => 'Desk', 'price' => 200],
        ]
    */

<a name="method-when"></a>
#### `when()`
The when method will execute the given callback when the first argument given to the method evaluates to true:

    $collection = Collection::make([1, 2, 3]);

    $collection->when(true, function ($collection) {
        return $collection->push(4);
    });

    $collection->when(false, function ($collection) {
        return $collection->push(5);
    });

    $collection->all();

    // [1, 2, 3, 4]
For the inverse of when, see the unless method.


<a name="method-whenEmpty"></a>
#### `whenEmpty()`
The whenEmpty method will execute the given callback when the collection is empty:

    $collection = Collection::make(['michael', 'tom']);

    $collection->whenEmpty(function ($collection) {
        return $collection->push('adam');
    });

    $collection->all();

    // ['michael', 'tom']

    $collection = Collection::make();

    $collection->whenEmpty(function ($collection) {
        return $collection->push('adam');
    });

    $collection->all();

    // ['adam']

    $collection = Collection::make(['michael', 'tom']);

    $collection->whenEmpty(function($collection) {
        return $collection->push('adam');
    }, function($collection) {
        return $collection->push('taylor');
    });

    $collection->all();

    // ['michael', 'tom', 'taylor']
For the inverse of whenEmpty, see the whenNotEmpty method.


<a name="method-whenNotEmpty"></a>
#### `whenNotEmpty()`
The whenNotEmpty method will execute the given callback when the collection is not empty:

    $collection = Collection::make(['michael', 'tom']);

    $collection->whenNotEmpty(function ($collection) {
        return $collection->push('adam');
    });

    $collection->all();

    // ['michael', 'tom', 'adam']

    $collection = Collection::make();

    $collection->whenNotEmpty(function ($collection) {
        return $collection->push('adam');
    });

    $collection->all();

    // []

    $collection = Collection::make();

    $collection->whenNotEmpty(function($collection) {
        return $collection->push('adam');
    }, function($collection) {
        return $collection->push('taylor');
    });

    $collection->all();

    // ['taylor']
For the inverse of whenNotEmpty, see the whenEmpty method.


<a name="method-where"></a>
#### `where()`
The where method filters the collection by a given key / value pair:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 100],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Door', 'price' => 100],
    ]);

    $filtered = $collection->where('price', 100);

    $filtered->all();

    /*
        [
            ['product' => 'Chair', 'price' => 100],
            ['product' => 'Door', 'price' => 100],
        ]
    */
The where method uses "loose" comparisons when checking item values, meaning a string with an integer value will be considered equal to an integer of the same value. Use the whereStrict method to filter using "strict" comparisons.


<a name="method-whereStrict"></a>
#### `whereStrict()`
This method has the same signature as the where method; however, all values are compared using "strict" comparisons.


<a name="method-whereBetween"></a>
#### `whereBetween()`
The whereBetween method filters the collection within a given range:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 80],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Pencil', 'price' => 30],
        ['product' => 'Door', 'price' => 100],
    ]);

    $filtered = $collection->whereBetween('price', [100, 200]);

    $filtered->all();

    /*
        [
            ['product' => 'Desk', 'price' => 200],
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Door', 'price' => 100],
        ]
    */

<a name="method-whereIn"></a>
#### `whereIn()`
The whereIn method filters the collection by a given key / value contained within the given array:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 100],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Door', 'price' => 100],
    ]);

    $filtered = $collection->whereIn('price', [150, 200]);

    $filtered->all();

    /*
        [
            ['product' => 'Bookcase', 'price' => 150],
            ['product' => 'Desk', 'price' => 200],
        ]
    */
The whereIn method uses "loose" comparisons when checking item values, meaning a string with an integer value will be considered equal to an integer of the same value. Use the whereInStrict method to filter using "strict" comparisons.


<a name="method-whereInStrict"></a>
#### `whereInStrict()`
This method has the same signature as the whereIn method; however, all values are compared using "strict" comparisons.


<a name="method-whereInstanceOf"></a>
#### `whereInstanceOf()`
The whereInstanceOf method filters the collection by a given class type:

    $collection = Collection::make([
        new User,
        new User,
        new Post,
    ]);

    return $collection->whereInstanceOf(User::class);

<a name="method-whereNotBetween"></a>
#### `whereNotBetween()`
The whereNotBetween method filters the collection within a given range:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 80],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Pencil', 'price' => 30],
        ['product' => 'Door', 'price' => 100],
    ]);

    $filtered = $collection->whereNotBetween('price', [100, 200]);

    $filtered->all();

    /*
        [
            ['product' => 'Chair', 'price' => 80],
            ['product' => 'Pencil', 'price' => 30],
        ]
    */

<a name="method-whereNotIn"></a>
#### `whereNotIn()`
The whereNotIn method filters the collection by a given key / value not contained within the given array:

    $collection = Collection::make([
        ['product' => 'Desk', 'price' => 200],
        ['product' => 'Chair', 'price' => 100],
        ['product' => 'Bookcase', 'price' => 150],
        ['product' => 'Door', 'price' => 100],
    ]);

    $filtered = $collection->whereNotIn('price', [150, 200]);

    $filtered->all();

    /*
        [
            ['product' => 'Chair', 'price' => 100],
            ['product' => 'Door', 'price' => 100],
        ]
    */
The whereNotIn method uses "loose" comparisons when checking item values, meaning a string with an integer value will be considered equal to an integer of the same value. Use the whereNotInStrict method to filter using "strict" comparisons.


<a name="method-whereNotInStrict"></a>
#### `whereNotInStrict()`
This method has the same signature as the whereNotIn method; however, all values are compared using "strict" comparisons.


<a name="method-wrap"></a>
#### `wrap()`
The static wrap method wraps the given value in a collection when applicable:

    $collection = Collection::wrap('John Doe');

    $collection->all();

    // ['John Doe']

    $collection = Collection::wrap(['John Doe']);

    $collection->all();

    // ['John Doe']

    $collection = Collection::wrap(Collection::make('John Doe'));

    $collection->all();

    // ['John Doe']

<a name="method-zip"></a>
#### `zip()`
The zip method merges together the values of the given array with the values of the original collection at the corresponding index:

    $collection = Collection::make(['Chair', 'Desk']);

    $zipped = $collection->zip([100, 200]);

    $zipped->all();

    // [['Chair', 100], ['Desk', 200]]

<a name="higher-order-messages"></a>
## Higher Order Messages
Collections also provide support for "higher order messages", which are short-cuts for performing common actions on collections. The collection methods that provide higher order messages are: average, avg, contains, each, every, filter, first,  flatMap, groupBy, keyBy, map, max, min, partition, reject, some, sortBy, sortByDesc,  sum, and unique.

Each higher order message can be accessed as a dynamic property on a collection instance. For instance, let's use the each higher order message to call a method on each object within a collection:

    $users = User::where('votes', '>', 500)->get();

    $users->each->markAsVip();
Likewise, we can use the sum higher order message to gather the total number of "votes" for a collection of users:

    $users = User::where('group', 'Development')->get();

    return $users->sum->votes;
