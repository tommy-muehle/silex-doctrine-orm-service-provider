<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use TM\Provider\DoctrineORMServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__ . '/test.db',
    ),
));
$app->register(new DoctrineORMServiceProvider(), array(
    'orm.options' => array(
        'proxies_dir' => null,
        'entity_dirs' => array(
            array('path' => __DIR__ . '/TM/Fixtures/Foo/Entity'),
            array('path' => __DIR__ . '/TM/Fixtures/Bar/Entity'),
        ),
        'annotations' => array(
            __DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
        )
    )
));

return $app;