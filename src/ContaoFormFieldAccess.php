<?php

declare(strict_types=1);

namespace Zoglo\ContaoFormFieldAccess;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoFormFieldAccess extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
