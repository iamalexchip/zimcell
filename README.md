# numValidator

This is a package which can be used to verify Zimbabwe mobile network phone numbers.

When calling function 2 parameters are required :

1. mobile payment sytem name / service provider name

   supported values for the first parameter are:
  * econet / ecocash
  * telecel / telecash
  * netone / onewallet

   nb: value should be in lower case and one word

2. the phone number to be verified

Like this:

```php

$object->isvalid($pamentSys, $phonum).
// $paymentSys = payment sysytem
// $phonum = phone number

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

  * not numeric
  * not 9 digits long

Spaces between digits are also removed. The formated number is stored in the property **formatedNum**.

Using our previously established  we can aquire this propert like so:

```php
$num->formatedNum;

```

Number is formated into a 9 digit number by removing +263, 263 and 0 from the first characters of the string.

this means the following numbers are formated as 772123456 :
* 0772 123 456
* +263 772 123 456
* 263772123456

There is a **test.php** file you can use to see the package in action.

Enjoy! :smiley: :thumbsup: