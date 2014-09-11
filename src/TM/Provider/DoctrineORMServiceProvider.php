<?php

namespace TM\Provider;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Doctrine ORM Provider
 */
class DoctrineORMServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     *
     * @throws \InvalidArgumentException
     */
    public function register(Application $app)
    {
        $app['orm.options'] = array();
        $app['orm.config'] = null;
        $app['orm.em'] = null;

        if (!$app['db'] instanceof Connection) {
            throw new \InvalidArgumentException('No instance of Doctrine\DBAL\Connection available.');
        }

        $app['orm.config'] = $app->share(function() use($app) {

            $app['orm.options'] = array_replace(
                array(
                    'proxies_dir' => null,
                    'cache'       => null,
                    'annotations' => array()
                ),
                $app['orm.options']
            );

            foreach ($app['orm.options']['annotations'] as $annotation) {
                AnnotationRegistry::registerFile($annotation);
            }

            $paths = array();

            foreach ($app['orm.options']['entity_dirs'] as $entity) {
                array_push($paths, $entity['path']);
            }

            $configuration = Setup::createAnnotationMetadataConfiguration(
                $paths,
                false,
                $app['orm.options']['proxies_dir'],
                $app['orm.options']['cache'],
                false
            );

            return $configuration;
        });

        $app['orm.em'] = $app->share(function() use($app) {
            return EntityManager::create($app['db'], $app['orm.config']);
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}