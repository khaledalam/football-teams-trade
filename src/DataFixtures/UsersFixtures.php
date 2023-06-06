<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager): void
    {
        /**
         * Create admin user
         *
         * email: admin@example.com
         * password: password
         */
        $user = new User();
        $user->setName("admin");
        $user->setEmail("admin@example.com");
        $user->setPassword($this->hasher->hash('password'));
        $user->addRole('ROLE_ADMIN');

        $admin = new Admin();
        $admin->setUser($user);

        $manager->persist($user);
        $manager->flush();
    }

    protected function loadData(ObjectManager $manager)
    {
        // TODO: Implement loadData() method.
    }
}
