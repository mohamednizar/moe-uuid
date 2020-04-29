# This package is developed for generate human readable Digital ID

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamednizar/moe-uuid.svg?style=flat-square)](https://packagist.org/packages/mohamednizar/moe-uuid)
[![Build Status](https://img.shields.io/travis/mohamednizar/moe-uuid/master.svg?style=flat-square)](https://travis-ci.org/mohamednizar/moe-uuid)
[![Quality Score](https://img.shields.io/scrutinizer/g/mohamednizar/moe-uuid.svg?style=flat-square)](https://scrutinizer-ci.com/g/mohamednizar/moe-uuid)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamednizar/moe-uuid.svg?style=flat-square)](https://packagist.org/packages/mohamednizar/moe-uuid)

This packe will generate a unique user in 7 types  of digits. You can increase the size of the digits.
Even thougt I adivce you to test you self before implement this packge.We have tested over continues  `1 Million ID`.
## Installation

You can install the package via composer:

```bash
composer require mohamednizar/moe-uuid
```

### Usage
 * Type 1: 25^4 IDs
 
``` 
MoeUuid::getUniqueAlphanumeric(1); Output : 

D8DR
F7D2
```
 * Type 2: 25^6 IDs
 
```
MoeUuid::getUniqueAlphanumeric(2); Output : 

QTK-GQM
QRR-CYY
``` 

 * Type 3: 25^8 IDs
 
```
MoeUuid::getUniqueAlphanumeric(3); Output : 

QVPV-KKPW
GRHT-8RKQ
``` 

 * Type 4: 25^10 IDs

```
MoeUuid::getUniqueAlphanumeric(4); Output : 

KY7V-99X3-7T
VJ2Q-DHMY-M7
```
 * Type 5: 25^12 IDs
 
```
MoeUuid::getUniqueAlphanumeric(5); Output : 

X4H2-H4Y2-XVTX
TTRB-KDXM-YVHQ
```

 * Type 6: 25^14 IDs
 
```
MoeUuid::getUniqueAlphanumeric(6); Output : 

3WD6-KDYT-DX72-JK
D6P3-MG44-C9MY-7T
```

 * Type 7: 25^16 IDs
 
```
MoeUuid::getUniqueAlphanumeric(7); Output : 

TMPG-GFYB-KYCT-B6B2
VG4H-DWP7-BQHF-C2BJ
```
### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email nizarucsc@gmail.com instead of using the issue tracker.

## Credits

- [Mohamed Nizar](https://github.com/mohamednizar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
