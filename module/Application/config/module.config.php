<?php

namespace Application;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Segment',
                'options' => [
                    'route'    => '/[:lang]',
                    'defaults' => [
                        'controller' => Controller\Index::class,
                        'action'     => 'index',
                        'lang'       => '',
                    ],
                ],
            ],
            'about' => [
                'type' => 'Segment',
                'options' => [
                    'route'    => '[/:lang]/about',
                    'defaults' => [
                        'controller' => Controller\About::class,
                        'action'     => 'index',
                        'lang'       => '',
                    ],
                ],
            ],
            'blog' => [
                'type' => 'Segment',
                'options' => [
                    'route'    => '[/:lang]/blog',
                    'defaults' => [
                        'controller' => Controller\Blog::class,
                        'action'     => 'index',
                        'lang'       => '',
                    ],
                ],
            ],
            'contact' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '[/:lang]/contact[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\Contact::class,
                        'action'     => 'index',
                        'lang'       => '',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            \Zend\Cache\Service\StorageCacheAbstractServiceFactory::class,
            \Zend\Log\LoggerAbstractServiceFactory::class,
        ],
        'factories' => [
            'translator' => \Zend\Mvc\Service\TranslatorServiceFactory::class,
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Application\Controller\Index'   => Controller\IndexController::class,
            'Application\Controller\About'   => Controller\AboutController::class,
            'Application\Controller\Blog'    => Controller\BlogController::class,
            'Application\Controller\Contact' => Controller\ContactController::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
            'application/index/index' => __DIR__ . '/../view/application/index/index.twig',
            'error/404'               => __DIR__ . '/../view/error/404.twig',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
            'ZfcTwigViewStrategy',
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
    // mail
    'mailman' => [
		'MailMan\SMTP' => [
		
		],
	],
];
