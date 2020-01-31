<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(EventRepository $eventRepository, ArtistRepository $artistRepository)
    {
        $artists = $artistRepository->findAll();
        shuffle($artists);
        $someArtists = array_slice($artists, 0, 3);
        return $this->render('home/index.html.twig', [
            'events' => $eventRepository->findBy([], [], 3),
            'artists' => $someArtists,
        ]);
    }

    /**
     * @Route("/circus", name="circus")
     */
    public function showCircus()
    {
        return $this->render('home/circus.html.twig');
    }
}
