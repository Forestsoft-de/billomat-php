# ForestSoft Billomat API

[![Build Status](https://travis-ci.org/Forestsoft-de/billomat-php.svg?branch=master)](https://travis-ci.org/Forestsoft-de/billomat-php)
[![codecov](https://codecov.io/gh/Forestsoft-de/billomat-php/branch/master/graph/badge.svg)](https://codecov.io/gh/Forestsoft-de/billomat-php)

This API implements the RESTful webservice of Billomat Billomat GmbH & Co. KG (https://www.billomat.com/)

## Notice
This API is under heavily development. Many Tasks has to be done.

## Running Unit Tests

```
user@terminal$ composer update --require-dev
user@terminal$ ./vendor/bin/phpunit -c tests/unit/phpunit.xml
```

## For Running Integration Tests

```
user@terminal$ cp tests/config.dist.yml tests/config.yml
user@terminal$ nano tests/config.yml # Provide user credentials for Billomat API
user@terminal$ ./vendor/bin/phpunit -c tests/integration/phpunit.xml
```

## Todos

The API is not completly implemented yet. See  https://www.billomat.com/api/ for full reference.

#### Account
https://www.billomat.com/api/account/
* Have to implement completly

#### Articles
https://www.billomat.com/api/artikel/
* Have to implement completly

#### Customers
https://www.billomat.com/api/kunden/
* Update an Customer

#### Suppliers
https://www.billomat.com/api/lieferanten/
* Have to implement completly

#### Invoices
https://www.billomat.com/api/rechnungen/
* Have to implement completly
 
#### Recurrings
https://www.billomat.com/api/abo-rechnungen/
* Have to implement completly

#### Offers
https://www.billomat.com/api/angebote/
* Have to implement completly

#### Reminders
https://www.billomat.com/api/mahnungen/
* Have to implement completly

#### Incomings
https://www.billomat.com/api/eingangsrechnungen/
* Have to implement completly

#### Credit Notes
https://www.billomat.com/api/gutschriften/
* Have to implement completly

#### Confirmations
https://www.billomat.com/api/auftragsbestaetigungen/
* Have to implement completly

#### Delivery Notes
https://www.billomat.com/api/lieferscheine/
* Have to implement completly

#### Letters
https://www.billomat.com/api/briefe/
* Have to implement completly

#### Settings
https://www.billomat.com/api/einstellungen/
* Have to implement completly

#### Users
https://www.billomat.com/api/benutzer/
* Have to implement completly

#### Activity Feed
https://www.billomat.com/api/aktivitaeten/
* Have to implement completly

#### Search
https://www.billomat.com/api/suche/
* Have to implement completly

#### Countries
https://www.billomat.com/api/laender/
* Have to implement completly

#### Currencies
https://www.billomat.com/api/waehrungen/
* Have to implement completly

## Contributions
Pull Requests are very welcome if unit tests provided also.
