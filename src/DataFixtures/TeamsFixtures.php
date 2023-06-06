<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\Team;
use App\Entity\TeamManager;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;

class TeamsFixtures extends BaseFixtures
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        // Create 20 teams!
        for ($i = 1; $i <= 50; $i++) {

            /**
             * Team Example:
             *
             * name: team 1 manager
             * email: team1@example.com
             * password: team1password
             */

            // Create team manager user
            $hash = $this->hasher->hash('team' . $i . 'password');
            $teamManager = new TeamManager();
            $teamManagerUser = new User();
            $teamManagerUser->setName("team " . $i . ' manager');
            $teamManagerUser->setEmail("team" . $i . '@example.com');
            $teamManagerUser->setPassword($hash);
            $teamManagerUser->addRole('ROLE_TEAM_MANAGER');
            $teamManager->setUser($teamManagerUser);

            $team = new Team();
            $team->setName('team ' . $i);
            $team->setCountry($this->faker->country);
            $team->setMoney(random_int(5000, 100000));
            $team->setTeamManager($teamManager);

            // Create random team players
            $playersCount = random_int(11, 20);
            for ($j = 1; $j <= $playersCount; $j++) {
                /**
                 * Player Example:
                 *
                 * name: player 1
                 * email: player1@example.com
                 * pass: player1password
                 */
                $hash = $this->hasher->hash('player' . $i . 'password');

                $playerUser = new User();
                $playerUser->setName("player " . $i);
                $playerUser->setEmail("player" . $i . '@example.com');
                $playerUser->setPassword($hash);
                $playerUser->addRole('ROLE_PLAYER');

                $player = new Player();
                $player->setSurname($this->faker->lastName);
                $player->setPrice(random_int(1000, 10000));
                $player->setUser($playerUser);

                $team->addPlayer($player);

            }

            $manager->persist($team);
            $manager->flush();

            $output = new ConsoleOutput();
            $output->writeln("\t<info>team $i with $playersCount players created! </info>");
        }

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
