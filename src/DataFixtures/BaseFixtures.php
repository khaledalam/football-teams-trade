<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

abstract class BaseFixtures extends Fixture
{
    /** @var ObjectManager */
    private $manager;

    /** @var Generator */
    protected $faker;

    /** @var PasswordHasherInterface */
    protected $hasher;

    public function __construct()
    {
        $this->faker = Factory::create();

        // configure different hashers via the factory
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt', 'cost' => 5], // low cost to speed up loading fixtures.
            'sodium' => ['algorithm' => 'sodium'],
        ]);

        // retrieve the hasher using bcrypt
        $this->hasher = $factory->getPasswordHasher('common');
    }

    abstract protected function loadData(ObjectManager $manager);

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadData($manager);
    }

    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);

            $this->manager->persist($entity);
            // store for usage later as App\Entity\ClassName_#COUNT#
            $this->addReference($className . '_' . $i, $entity);
        }

    }
}
