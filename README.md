**Extended dumper, show detailed information about object**


# Information

**Dump contains:**
    
    - line where dump called
    - file where dump called
    - dumped variable or object detailed information
    - parent class of object
    - class public methods

_Basically uses Symfony var-dumper_ https://github.com/symfony/var-dumper


# Using

For dump any variable use short function **ff**.

```php
ff($your_variable);
``` 

If you need dump your variable without clear output buffer and terminating program execute add second parameter **false**.

```php
ff($your_variable, false);
```

And you'll see something like this

![Scheme](https://github.com/dobrik/extended_dumper/raw/master/media/img_1.jpg)