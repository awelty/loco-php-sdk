<?php

namespace Awelty\Component\Loco\Bridge\Silex;

use Awelty\Component\Loco\Loco;
use Awelty\Component\Loco\LocoSignatureProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LocoServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['loco.full_access_key'] = '';

        $container['loco'] = function (Container $container) {

            $signatureProvider = new LocoSignatureProvider($container['loco.full_access_key']);

            return new Loco($signatureProvider);
        };
    }
}
