# Amylian Utils for PHP (Package amylian/amylian-utils)

Copyright (c) 2018, [Andreas Prucha (Abexto - Helicon Software Development / Amylian Project)](http://www.abexto.com]) <andreas.prucha@gmail.com>

This package contains a collection of miscellaneous utility classes and functions

## Installation

To install this library, run the command below and you will get the latest version

``` bash
composer require amylian/amylian-utils --dev
```

##PropertyTrait

Using \Amylian\Utils\PropertyTrait in a class enables property support by getter and setter.

Access to private/protected member variables are automatically redirected to methods 
following the getXxx and setXxx convention.

Example:

```
/**
 * @property mixed $prop Property automatically getted and setted by getProp and setProp
 */
class ObjectWithProperties
{
    use \Amylian\Utils\ṔropertyTrait;
    
    public $memb = null;
    
    private $prop = null;
    
    public function getProp()
    {
        return $this->prop;
    }
    
    public function setProp($value)
    {
        $this->prop = $value;
    }
    
}
```

In this example, both `$obj->memb` and `$obj->prop` will be acceable from outside as the
methods `getProp()` and `setProp()` are public and automatically called.

**NOTE**: \Amylian\Utils\ṔropertyTrait implements the magic functions `__get()`, `__set()`, `__isset()`
and `__unset()`. 

