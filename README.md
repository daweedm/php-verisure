# php-verisure
PHP library to easily interface with the Verisure API

## Installation
### Debian
``` apt-get install git php5 php5-curl && git clone https://github.com/DaweedM/php-verisure.git```

## Features
- Switch on/off motion detector on smart cams

## Usage example
``` 
<?php
require_once('php-verisure/AutoLoader.php');
$verisure = new Verisure\VInterface("YOUR_ACCOUNT_EMAIL", "YOUR_ACCOUNT_PASSWORD");
$verisure->login();
$verisure->init();
$verisure->setCameraMotionDetectorState("XXXX YYYY", Verisure\SecuritasK::OFF); // Your smartcam serial number

?>
```