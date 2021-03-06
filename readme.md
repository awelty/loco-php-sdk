# Loco PHP SDK

Unofficial PHP SDK for https://localise.biz. The approach here is to use guzzlehttp/guzzle as a client and keep the SDK as simple as possible.

## Install

```
composer require awelty/loco-php-sdk:dev-master
```
A stable version will eventually be released one day...

### Create a client

#### With Silex

You can use the service provider: 

```
<?php 

use Awelty\Component\Loco\Bridge\Silex\LocoServiceProvider;

$app->register(new LocoServiceProvider(), [
    'loco.full_access_key' => 'your_key'
]);
```

It will create a service named "loco" (see usage below).

#### Or manually

```
<?php 

use Awelty\Component\Loco\Loco;
use Awelty\Component\Loco\LocoSignatureProvider;

// Loco use header auth
$signatureProvider = new LocoSignatureProvider($your_key_here);

$loco = new Loco($signatureProvider, $someGuzzleConfig = []);
```

### Usage

Loco clients are mapped with the API documentation of loco here: https://localise.biz/api#console
In this way, it should be very easy to use it.

- tags
```
<?php 

$tags = $loco->tags()->getTags();

// TODO, createTag, patch($tag) (and maybe a shortcut "rename"), delete($tag)
```




- Export  
```
<?php 

$translations = $loco->export()->all($extension, $options = []);
$translations = $loco->export()->locale($locale, $extension, $options = []);

// TODO archive and template 

```

- TODO import, auth, etc. Contributions are welcome !
