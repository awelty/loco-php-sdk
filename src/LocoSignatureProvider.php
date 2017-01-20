<?php

namespace Awelty\Component\Loco;

use Awelty\Component\Security\HeaderSignatureProvider;

class LocoSignatureProvider extends HeaderSignatureProvider
{
    public function __construct($key)
    {
        parent::__construct('Authorization', 'Loco '.$key);
    }
}
