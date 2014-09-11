<?php

namespace TM\Tests\Provider;

/**
 * Class DoctrineORMServiceProviderTest
 *
 * @package TM\Tests\Provider
 */
class DoctrineORMServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected function setUp()
    {
        parent::setUp();

        $app = require __DIR__ . '/../../bootstrap.php';
        $this->em = $app['orm.em'];
    }

    public function testEntityManagerIsInstantiated()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->em);
    }

    public function testEntitiesAreCorrectMapped()
    {
        $metaData = $this->em->getMetadataFactory()->getAllMetadata();
        $expectedClassesNames = array(
            'TM\Tests\Fixtures\Bar\Entity\Foo',
            'TM\Tests\Fixtures\Bar\Entity\Bazz',
            'TM\Tests\Fixtures\Foo\Entity\Bar',
        );

        $this->assertCount(3, $metaData);

        /* @var $classMetaData \Doctrine\ORM\Mapping\ClassMetadata*/
        foreach ($metaData as $classMetaData) {
            $this->assertContains($classMetaData->getName(), $expectedClassesNames);
        }
    }
}
