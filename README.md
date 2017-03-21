# php-verisure
PHP library to easily interface with the Verisure API

## Installation
### Debian
```bash
apt-get install git php5 php5-curl && git clone https://github.com/daweedm/php-verisure
```

## Features
- Switch on/off motion detector on smart cams

## Usage example
```php 
<?php
require_once('php-verisure/AutoLoader.php');
$verisure = new Verisure\VInterface("YOUR_ACCOUNT_EMAIL", "YOUR_ACCOUNT_PASSWORD");
$verisure->login();
$verisure->init();
$verisure->setCameraMotionDetectorState("XXXX YYYY", Verisure\SecuritasK::OFF); // Your smartcam serial number

?>
```

#### Thanks
*[`persandstrom/python-verisure`](https://github.com/persandstrom/python-verisure/issues/65)*
