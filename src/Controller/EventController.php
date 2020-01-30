<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository, RepresentationRepository $representationRepository): Response
    {

        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'representations' => $representationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event, RepresentationRepository $representationRepository): Response
    {
        $id = $event->getId();

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'representations' => $representationRepository->findDateFromNow($id),
        ]);
    }
}
