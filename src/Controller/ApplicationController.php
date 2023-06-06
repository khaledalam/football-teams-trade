<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(TeamRepository $teamRepository, PlayerRepository $playerRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $teams = $teamRepository->findAll();
        $playerNotAssociateWithAnyTeams = $playerRepository->findBy(['team' => null]);
        $countries = Countries::getNames();

        return $this->render('homepage.html.twig', [
            'countries' => $countries,
            'teams' => $teams,
            'playerNotAssociateWithAnyTeams' => $playerNotAssociateWithAnyTeams
        ]);
    }

    #[Route('/team/{name}', name: 'app_view_team')]
    public function team(Request $request, TeamRepository $teamRepository): Response
    {
        $name = $request->get('name');

        $team = $teamRepository->findBy(['name' => $name])[0] ?? null;

        return $this->render('team.html.twig', [
            'team' => $team
        ]);
    }

    #[Route('/buy/{player_id}', name: 'app_buy_player')]
    public function buy_player(Request $request, PlayerRepository $playerRepository): Response
    {
        $player_id = $request->get('player_id');

        $player = $playerRepository->find($player_id);

        if (!$player) {
            return $this->render('team.html.twig', [
                'team' => $team
            ]);
        }

        $team = $teamRepository->findBy(['name' => $name])[0] ?? null;


        return $this->render('team.html.twig', [
            'team' => $team
        ]);
    }

    #[Route('/create-team', name: 'app_create_team', methods: ['POST'])]
    public function create_team(Request $request, EntityManagerInterface $em): Response
    {
        $name = $request->get('name');
        $country = $request->get('country');
        $money = $request->get('money');
        $players = $request->get('players');

        try {
            $team = new Team();
            $team->setName($name);
            $team->setCountry($country);
            $team->setMoney($money);

            foreach ($players as $player) {
                $team->addPlayer($player);
            }

            $em->persist($team);
            $em->flush();


            return $this->render('team.html.twig', [
                'team' => $team
            ]);
        }catch (\Exception $e) {
            $request->getSession()
                ->getFlashBag()
                ->add('error', $e->getMessage());
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }
    }

    #[Route('/lang', name: 'app_lang', methods: ['POST'])]
    public function lang(Request $request)
    {
        $lang = $request->get('lang');

        return $this->json([
            'lang' => $lang,
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }
}
