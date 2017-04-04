# php-verisure
PHP library to easily interface with the Verisure API

## Installation
Requirements : **PHP >= 5.6** && **cURL extension** for PHP
### Debian
```bash
apt-get install git php5 php5-curl && git clone https://github.com/daweedm/php-verisure
```

## Features
- Switch on/off motion detector on smart cams
- Switch on/off smartplugs

## Usage example

### Setting camera motion detector state
```php 
<?php
require_once('php-verisure/AutoLoader.php');
$verisure = new Verisure\VInterface("YOUR_ACCOUNT_EMAIL", "YOUR_ACCOUNT_PASSWORD");
$verisure->login();
$verisure->init();
$verisure->setCameraMotionDetectorState("XXXX YYYY", Verisure\SecuritasK::OFF); // Your smartcam serial number
?>
```

### Setting smartplug state
```php 
<?php
require_once('php-verisure/AutoLoader.php');
$verisure = new Verisure\VInterface("YOUR_ACCOUNT_EMAIL", "YOUR_ACCOUNT_PASSWORD");
$verisure->login();
$verisure->init();
$verisure->setSmartPlugState("XXXX YYYY", Verisure\SecuritasK::OFF); // Your smartplug serial number
?>
```

### Setting the state of several smartplugs
```php 
<?php
require_once('php-verisure/AutoLoader.php');
$verisure = new Verisure\VInterface("YOUR_ACCOUNT_EMAIL", "YOUR_ACCOUNT_PASSWORD");
$verisure->login();
$verisure->init();
$verisure->setMultipleSmartPlugsState(array(
	["XXXX YYYY", Verisure\SecuritasK::OFF],
	["XXXX YYYY", Verisure\SecuritasK::OFF]
));
?>
```

#### Thanks
*[`persandstrom/python-verisure`](https://github.com/persandstrom/python-verisure/issues/65)*
