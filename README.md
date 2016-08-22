# Darumaotoshi

[だるま落とし](https://www.google.co.jp/search?q=だるま落とし&safe=off&source=lnms&tbm=isch)

Slide delete (export delete) plugin for CakePHP 3

## Installation

```sh
$ composer require k1low/darumaotoshi
```

### Enable plugin

```sh
$ bin/cake plugin load Darumaotoshi
```

### Load required database table

```sh
$ bin/cake migrations migrate --plugin Darumaotoshi
```

## Usage

```php
// in the initialize() method
$this->addBehavior('Darumaotoshi.Darumaotoshi');
```

### Cascading deletion

If you'd like to have related records marked as trashed when deleting a parent item, you can just attach the behavior to the related table classes, and set the `'dependent' => true, 'cascadeCallbacks' => true` options in the table relationships.

## Code References

### [UseMuffin/Trash](https://github.com/UseMuffin/Trash)

```
Copyright (c) 2015, [Use Muffin][muffin] and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[mit]:http://www.opensource.org/licenses/mit-license.php
[muffin]:http://usemuffin.com
```

## License

under The MIT License.
