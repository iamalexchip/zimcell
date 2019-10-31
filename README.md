# ZimCell

## Overview
A package for working with Zimbabwean phone numbers. You can verify if a phone number belongs to a network or get the provider it belongs to.

## Demo
You can see it in action here https://zimcell.herokuapp.com

## Installation
```
composer require zerochip/zimcell
```

## Usage
First import the class into your file
```php
use Zerochip\Zimcell 
```

## Methods

- [refine](#refine)
- [intlFormat](#intlformat)
- [valid](#valid)
- [is](#is)
- [getProvider](#getprovider)

----

### refine
`refine($cellnumber)`

Cleans up the cell number of any legiblity helpers by removing the following: 

 - Spaces
 - Country code (+263 or 263)
 - The leading zero
```php
Zimcell::refine('+263772 123 456');
Zimcell::refine('263772 123456');
Zimcell::refine('0772 123 456');
Zimcell::refine('0772123456');

// All the above return 772123456
```

### intlFormat
`intlFormat($cellnumber)`

Internationalises the phone number with a "+" prefix.

```php
Zimcell::intlFormat('0772 123 456');
// return +263772123456
```

### valid
`valid($cellnumber)`

Checks if the given cellnumber is a valid Zimbabwean number by:

- running the refine function
- checking if the refined number is 9 digits long
- checking if the refined number starts with a 7

```php
ZimCell::valid('0772 123 456');
// returns true

ZimCell::valid('0872 12 34 56');
//returns false, refined number starts with an 8 i.e 872123456

Zimcell::valid('0772 12345');
// returns false, refined number will be 8 digits long i.e 77212345
```

### is
`is($provider,  $cellnumber)`

Verifies if a number belongs to a given provider or service. The case of the provider name does not matter since they are converted to lower case before verifying.
```php
Zimcell::is('econet', '0772 123 456');
// returns true

Zimcell::is('teleCash', '0772 123 456');
// returns false, note use of camelCase for provider name

Zimcell::is('netcel', '0772 123 456');
// returns null, netcel is not a supported provider
```
Supported provider and service names are as follows:

- econet
- ecocash
- telecel
- telecash
- netone
- onemoney

### getProvider
`getProvider($cellnumber)`

returns the provider for a phone number.
```php
Zimcell::getProvider('0712123456');
// returns netone

Zimcell::getProvider('0812123456');
// returns null
```
