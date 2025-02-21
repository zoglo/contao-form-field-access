<?php

declare(strict_types=1);

namespace Zoglo\ContaoFormFieldAccess\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Zoglo\ContaoFormFieldAccess\ContaoFormFieldAccess;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoFormFieldAccess::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['contao-form-field-access'])
        ];
    }
}
