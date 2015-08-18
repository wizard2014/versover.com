<?php
/**
 * Global navigation config
 */

$translator = new \Zend\I18n\Translator\Translator;

return [
    'navigation' => [
        'default' => [
            [
                'label' => $translator->translate('Главная'),
                'route' => 'home',
                'class' => 'nav-item'
            ], [
                'label' => $translator->translate('О нас'),
                'route' => 'about',
                'class' => 'nav-item'
            ], [
                'label' => $translator->translate('Blog'),
                'route' => 'blog',
                'class' => 'nav-item hide'
            ], [
                'label' => $translator->translate('Контакты'),
                'route' => 'contact',
                'class' => 'nav-item'
            ]
        ],
    ],
    'service_manager' => [
        'factories' => [
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ],
    ],
];