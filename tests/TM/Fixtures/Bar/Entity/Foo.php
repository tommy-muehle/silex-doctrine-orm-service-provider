<?php

namespace TM\Tests\Fixtures\Bar\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class Foo
 *
 * @Entity
 *
 * @package TM\Tests\Fixtures\Bar\Entity
 */
class Foo
{
    /**
     * @var int
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
