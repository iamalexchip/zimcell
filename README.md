# numValidator

phone number verifier for zim networks.
the function has 2 parameters:

1. the payment sysytem
2. the phone number to be verified

Like this:
```php
$object->isvalid($pamentSys, $phonum).
// $paymentSys = payment sysytem, $phonum = phone number
```

Example of use in code:
```php

$num = new NumValidator();

$paymentSys = 'econet';
$phonum = '0771 000 001';

$num->isvalid($paymentSys,$phonum);

```
This function returns 4 values:

1. **true**
when the number is valid

2. **false**
when its in valid

3. **unknown sys**
when an unknown payment system is entered

4. **num error**
when the value for the phone number is:

* not numeric or of
* not equal to 9 digits

Number is formated into a 9 digit number by removing +263, 263 and 0 from the first characters of the string.
Spaces between digits are also removed.
The formated number is stored in the property *formatedNum*. 
Using our previously established  we can aquire this propert like so:

```php
$num->formatedNum;

```   