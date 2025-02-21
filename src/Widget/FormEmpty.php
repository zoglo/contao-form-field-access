<?php

declare(strict_types=1);

namespace Zoglo\ContaoFormFieldAccess\Widget;

use Contao\Widget;

class FormEmpty extends Widget
{
    public function parse($arrAttributes = null): string
    {
        return '';
    }

    public function generate(): string
    {
        throw new \BadMethodCallException('Calling generate() has been deprecated, you must use parse() instead!');
    }
}
