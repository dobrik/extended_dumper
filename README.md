**Extended dumper, show detailed information about object**


# Information

**Dump contains:**
    
    - line where dump called
    - file where dump called
    - dumped variable or object detailed information
    - parent class of object
    - class public methods with arguments

_Basically uses Symfony var-dumper_ https://github.com/symfony/var-dumper


# Using

For dump any variable or few variables use short function **ff**.

```php
ff($var);
``` 

And you'll see something like this
![Scheme](https://github.com/dobrik/extended_dumper/raw/master/media/img_1.jpg)

Or

```php
ff($var1, $var2);
``` 

In this case your variables will be dumped as array and methods don't be shown.

