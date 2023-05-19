<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;

use Phalcon\Config;



$config = new Config([]);

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require_once BASE_PATH."/vendor/autoload.php";

$container = new FactoryDefault();

$container->set(
    'router',
    function () {
        $router = new Router();

        $router->setDefaultModule('user');

        // $router->add(
        //     '/index',
        //     [
        //         'module'     => 'user',
        //         'controller' => 'index',
        //         'action'     => 'index',
        //     ]
        // );

        $router->add(
            '/detail',
            [
                'module'     => 'user',
                'controller' => 'index',
                'action'     => 'detail',
            ]
        );

        $router->add(
            '/admin',
            [
                'module'     => 'admin',
                'controller' => 'index',
                'action'     => 'index',
            ]
        );

        $router->add(
            '/admin/login',
            [
                'module'     => 'admin',
                'controller' => 'index',
                'action'     => 'login',
            ]
        );

        $router->add(
            '/admin/signup',
            [
                'module'     => 'admin',
                'controller' => 'index',
                'action'     => 'signup',
            ]
        );

        $router->add(
            '/admin/check',
            [
                'module'     => 'admin',
                'controller' => 'index',
                'action'     => 'check',
            ]
        );

        $router->add(
            '/admin/product',
            [
                'module'     => 'admin',
                'controller' => 'product',
                'action'     => 'index',
            ]
        );

        $router->add(
            '/admin/add',
            [
                'module'     => 'admin',
                'controller' => 'product',
                'action'     => 'add',
            ]
        );

        $router->add(
            '/admin/edit',
            [
                'module'     => 'admin',
                'controller' => 'product',
                'action'     => 'edit',
            ]
        );

        $router->add(
            '/admin/update',
            [
                'module'     => 'admin',
                'controller' => 'product',
                'action'     => 'update',
            ]
        );

        $router->add(
            '/admin/delete',
            [
                'module'     => 'admin',
                'controller' => 'product',
                'action'     => 'delete',
            ]
        );


        return $router;
    }
);

$container->set(
    'mongo',
    function () {
        $mongo = new MongoDB\Client(
            "mongodb+srv://root:Password123@mycluster.qjf75n3.mongodb.net/?retryWrites=true&w=majority"
        );
        return $mongo->multi_module;
    },
    true
);

$application = new Application($container);

$application->registerModules(
    [
        'admin' => [
            'className' => \Multi\Admin\Module::class,
            'path'      => APP_PATH . '/admin/Module.php',
        ],
        'user'  => [
            'className' => \Multi\User\Module::class,
            'path'      => APP_PATH . '/user/Module.php',
        ]
    ]
);

try {
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}
