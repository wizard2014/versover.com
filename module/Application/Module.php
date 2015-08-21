<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // translation
        $eventManager->attach(MvcEvent::EVENT_ROUTE, function (MvcEvent $e) {
            $sm = $e->getApplication()->getServiceManager();

            $translator = $sm->get('translator');
            $lang       = $e->getRouteMatch()->getParam('lang');

            if (strtolower($lang) == 'ru') {
                $lang = 'ru_RU';

                // nav
                $navItems = $sm->get('navigation');

                foreach ($navItems as $item) {
                   $item->setParams(['lang' => 'ru']);
                }
            }

            $translator->setLocale($lang);
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
}
