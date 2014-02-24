# Hash

## Hash (ported or to port methods)

### clear
### collect
> ### collect_concat
> ### compare_by_identity
> ### compare_by_identity?

### Compact (not in ruby Hash)

Removes null and empty
```php
<?php

$hash = new Hash(array(
  'foo' => 'bar',
  'null' => null,
  'empty' => ''
));

$hash->compact()->toArray(); // array('foo' => 'bar')
```


### count ### TODO
> ### cycle
### delete
### delete_if
> ### detect
> ### drop
> ### drop_while
### each
> ### each_cons
> ### each_entry
> ### each_key
> ### each_pair
> ### each_slice
> ### each_value
> ### each_with_index
> ### each_with_object
### empty? => isEmpty
> ### entries
### fetch
> ### find
> ### find_all
> ### find_index
> ### first
> ### flat_map
> ### flatten
> ### grep
> ### group_by
### has_key?
> ### has_value?
> ### include?
> ### index
> ### inject
> ### invert
> ### keep_if
> ### key
> ### key?
### keys
> ### lazy
### length
### map
> ### max
> ### max_by
> ### member?
### merge
> ### merge!
> ### min
> ### min_by
> ### minmax
> ### minmax_by
> ### none?
> ### one?
> ### partition
> ### rassoc
> ### reduce
> ### rehash

### reject
```php
$hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

$filtered = $hash->reject(function ($value, $key) {
    return $value === 'barfoo';
});

// array('foo' => 'foobar')

```
> ### reject!

> ### replace

> ### reverse_each

### select
New Hash with elements that match the given callback

```php
<?php
$hash = new Hash(array('foo' => 'foobar', 'bar' => 'barfoo'));

$filtered = $hash->select(function ($value, $key) {
    return $value !== 'barfoo';
})->toArray();

// array('foo' => 'foobar')
```

> ### select!
> ### shift
### size
> ### slice_before
> ### sort
> ### sort_by
> ### store
> ### take
> ### take_while
> ### to_a
> ### to_h
> ### to_hash
> ### update
> ### value?
### values
### values_at
> ### zip
