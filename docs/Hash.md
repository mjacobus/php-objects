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
- delete
- delete_if
- detect
- drop
- drop_while
- each
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
- fetch
- find
- find_all
- find_index
- first
- flat_map
- flatten
- grep
- group_by
- has_key?
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
```php
Hash::create(['a' => 'b'])->keys()->toArray(); // array('a')
```

- lazy
- length

### map
Maps modified elements into a new hash
```php
$hash = new Hash(array('a' => 'b', 'c' => 'd'));

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
});

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
