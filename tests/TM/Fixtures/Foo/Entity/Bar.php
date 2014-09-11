<?php

namespace TM\Tests\Fixtures\Foo\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class Bar
 *
 * @Entity
 *
 * @package TM\Tests\Fixtures\Bar\Entity
 */
class Bar
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
