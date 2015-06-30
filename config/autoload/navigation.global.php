<?php

/**
 * Global navigation config
 */

return [
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home',
                'class' => 'nav-item'
            ], [
                'label' => 'Work',
                'route' => 'work',
                'class' => 'nav-item'
            ], [
                'label' => 'About',
                'route' => 'about',
                'class' => 'nav-item'
            ], [
                'label' => 'Blog',
                'route' => 'blog',
                'class' => 'nav-item'
            ], [
                'label' => 'Contact',
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