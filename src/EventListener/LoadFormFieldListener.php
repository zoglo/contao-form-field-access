<?php

declare(strict_types=1);

namespace Zoglo\ContaoFormFieldAccess\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\Form;
use Contao\StringUtil;
use Contao\Widget;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Zoglo\ContaoFormFieldAccess\Widget\FormEmpty;

#[AsHook('loadFormField')]
class LoadFormFieldListener
{
    public function __construct(
        private readonly TokenChecker $tokenChecker,
        private readonly AuthorizationCheckerInterface $authorizationChecker,
    ) {
    }

    public function __invoke(Widget $widget, string $formId, array $formData, Form $form): Widget
    {
        // @phpstan-ignore-next-line
        if (!$widget->protected && !$widget->guests)
        {
            return $widget;
        }

        if ($widget->guests && $this->tokenChecker->hasFrontendUser()) // @phpstan-ignore property.notFound
        {
            return new FormEmpty();
        }

        if (!$widget->protected) // @phpstan-ignore property.notFound
        {
            return $widget;
        }

        $groups = StringUtil::deserialize($widget->groups, true); // @phpstan-ignore property.notFound

        return $this->authorizationChecker->isGranted(ContaoCorePermissions::MEMBER_IN_GROUPS, $groups)
            ? $widget
            : new FormEmpty();
    }
}
