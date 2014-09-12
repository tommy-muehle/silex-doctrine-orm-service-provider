silex-doctrine-orm-service-provider
===================================

This provider is a very leightweight doctrine orm service provider for silex projects.
It can only handle simple annotations like @Entity, @Table and so long.
But in many cases this is sufficient.

Install via composer:

Add ['tm/silex-doctrine-orm-service-provider'](https://packagist.org/packages/tm/silex-doctrine-orm-service-provider) to the dependencies in your projects composer.json file
and update your dependencies.

A usage example:

    $app->register(new TM\Provider\DoctrineORMServiceProvider(), array(
        'orm.options' => array(
            'proxies_dir' => __DIR__ . '/cache/doctrine/proxies', // set to null if you want to use the system configured directory path for temporary files
            'entity_dirs' => array(
                array('path' => __DIR__ . '/../src/Foo/Entity'),
                array('path' => __DIR__ . '/../src/Bar/Entity'),
                // ...
            ),
            'annotations' => array(
                __DIR__ . '/../vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
            )
        )
    ));

    /* @var $em \Doctrine\ORM\EntityManager */
    $em = $app['orm.em'];

    // ... use $em in your application

So all entites in the namespaces Foo\Entity (for example Foo\Entity\Blog, Foo\Entity\Post and Foo\Entity\Comment)
and Bar\Entity are mapped and can be handeled with the entity-manager.

If you need more advanced options please use [dflydev-doctrine-orm-service-provider](https://github.com/dflydev/dflydev-doctrine-orm-service-provider) instead.