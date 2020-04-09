### Live Link

https://algorithm-maxvalue.herokuapp.com/algorithm

### Instalation


```php
git clone https://github.com/aszadkowska/algorithm.git && cd algortihm

composer install && php bin/console server:start
```

### Documentation

You have 2 possibilities to find maximum value for your input.

By using web interface:

```php
http://{domain}/
```

By using algorithm:maxValue command:

```php
php bin/console algorithm:maxValue {arguments}
```

where the arguments are numbers between 1 - 99999 separated by spaces

```php
php bin/console algorithm:maxValue 6 28 91 129
```