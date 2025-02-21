<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_form_field']['fields']['protected'] = [
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'submitOnChange' => true,
    ],
    'sql' => [
        'type' => 'string',
        'length' => 1,
        'default' => '',
        'fixed' => true,
    ],
];
$GLOBALS['TL_DCA']['tl_form_field']['fields']['groups'] = [
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'foreignKey' => 'tl_member_group.name',
    'eval' => [
        'mandatory' => true,
        'multiple' => true,
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
        'length' => 65535,
    ],
    'relation' => [
        'type' => 'hasMany',
        'load' => 'lazy',
    ],
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['guests'] = [
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'w50',
    ],
    'sql' => [
        'type' => 'string',
        'length' => 1,
        'default' => '',
        'fixed' => true,
    ],
];

$paletteManipulator = PaletteManipulator::create()
    ->addLegend('protected_legend', 'template_legend', PaletteManipulator::POSITION_AFTER, true)
    ->addField(['protected', 'guests'], 'protected_legend', PaletteManipulator::POSITION_APPEND)
;

foreach (array_keys($GLOBALS['TL_DCA']['tl_form_field']['palettes']) as $palette)
{
    if ('default' === $palette || '__selector__' === $palette)
    {
        continue;
    }

    $paletteManipulator->applyToPalette((string) $palette, 'tl_form_field');
}

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'protected';
$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['protected'] = 'groups';
