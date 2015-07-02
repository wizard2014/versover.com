<?php
/**
 * Global navigation config
 */

return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Главная',
                'route' => 'home',
                'class' => 'nav-item'
            ], [
                'label' => 'О нас',
                'route' => 'about',
                'class' => 'nav-item'
            ], [
                'label' => 'Blog',
                'route' => 'blog',
                'class' => 'nav-item hide'
            ], [
                'label' => 'Контакты',
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