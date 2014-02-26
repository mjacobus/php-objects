# Hash

This is a (work in progress) port of Ruby Hash to PHP. Not all methods will be ported.
The examplified methods are already ported. The non documented methods must be implemented.

## Hash (ported or to port methods)
- clear
- collect - Use map instead.

### compact (not in ruby Hash)
Removes null and empty
```php
$hash = new Hash(array(
  'foo'   => 'bar',
  'null'  => null,
  'empty' => ''
));

$hash->compact()->toArray(); // array('foo' => 'bar')
```
### count
Get the number of keys
```php
Hash::create(['a' => 'b'])->count(); // 1
```
- cycle

### delete
Removes the element from the Hash and returns it.
```php
$object = new Something;

$hash = Hash::create(['foo' => $object, 'b' => 'bar']);

$deleted = $hash->delete('foo');

$hash->toArray());   // ['b' => 'bar']

$deleted === $object // true
```
- delete_if
- detect
- drop
- drop_while

### each

Iterates through the values and keys of the object.

```php
$hash = new Hash(array('a' => 'b', 'c' => 'd'));

$array = new Hash;

$hash->each(function($value, $key) use ($array) {
    $array[] = $key;
    $array[] = $value;
});

$hash->toArray() // array( 'a', 'b', 'c', 'd');
```

- each_cons
- each_entry
- each_key
- each_pair
- each_slice
- each_value
- each_with_index
- each_with_object
- empty (see isEmpty)
- entries

### fetch

Gets the value by the given key. If the key is not set, throws InvalidArgumentException

```php
$hash = Hash::create(['foo' => 'bar']);

$hash->fetch('foo') // bar

$hash->fetch('bar') // throws InvalidArgumentException
```

- find
- find_all
- find_index
- first
- flat_map
- flatten
- grep
- group_by

### hasKey

Check if key exists.

```php
$hash->hasKey('foo') // true
```

- has_value?
- include?
- index
- inject
- invert

### isEmpty
Is empty?
```php
Hash::create(['a' => 'b'])->isEmpty(); // false
```

- keep_if
- key
- key?

### keys
Get the array keys. Return a Hash.
```php
Hash::create(['a' => 'b'])->keys()->toArray(); // array('a')
```

- lazy
- length

### map
Maps modified elements into a new hash
```php
$hash = new Hash(array(
  'a' => 'b',
  'c' => 'd'
));

$mapped = $hash->map(function($value, $key) {
    return $key . $value;
})->toArray();

// array('ab', 'cd');
```
- max
- max_by
- member?
- merge
- merge!
- min
- min_by
- minmax
- minmax_by
- none?
- one?
- partition
- rassoc
- reduce
- rehash

### reject
New Hash with elements that will not match the given callback
```php
$hash = new Hash(array(
  'foo' => 'foobar',
  'bar' => 'barfoo'
));

$filtered = $hash->reject(function($value, $key) {
    return $value === 'barfoo';
})->toArray();

// array('foo' ='foobar')
```
- reject!
- replace
- reverse_each

### select
New Hash with elements that match the given callback
```php
$hash = new Hash(array(
  'foo' => 'foobar',
  'bar' => 'barfoo'
));

$filtered = $hash->select(function($value, $key) {
    return $value !== 'barfoo';
})->toArray();

// array('foo' ='foobar')
```
- select!
- shift
- size
- slice_before
- sort
- sort_by
- store
- take
- take_while
- to_a
- to_h
- to_hash
- update
- value?
- values
- values_at
- zip
