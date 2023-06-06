<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;

class AppFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


//        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    protected function loadData(ObjectManager $manager)
    {
        // TODO: Implement loadData() method.
    }
}
