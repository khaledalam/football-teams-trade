<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Player;
use App\Entity\User;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;

class PlayersFixtures extends BaseFixtures
{
    public function load(ObjectManager $manager): void
    {
        /**
         * Create some random players (not associated with any teams.
         */
        $playersCount = random_int(50, 100);
        for ($j = 100; $j <= 100 + $playersCount; $j++) {
            /**
             * Player Example:
             *
             * name: player100
             * email: player100@example.com
             * pass: player100password
             */
            $hash = $this->hasher->hash('player' . $j . 'password');

            $playerUser = new User();
            $playerUser->setName("player " . $j);
            $playerUser->setEmail("player" . $j . '@example.com');
            $playerUser->setPassword($hash);
            $playerUser->addRole('ROLE_PLAYER');

            $player = new Player();
            $player->setSurname($this->faker->lastName);
            $player->setPrice(random_int(1000, 10000));
            $player->setUser($playerUser);

            $manager->persist($player);
            $manager->flush();
        }
    }

    protected function loadData(ObjectManager $manager)
    {
        // TODO: Implement loadData() method.
    }
}
