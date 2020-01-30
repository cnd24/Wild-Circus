<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(EventRepository $eventRepository)
    {
        return $this->render('home/index.html.twig', [
            'events' => $eventRepository->findBy([], [], 3),
        ]);
    }
}
