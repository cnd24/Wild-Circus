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
 * @Route("/admin/event")
 */
class EventAdminController extends AbstractController
{
    /**
     * @Route("/", name="event_index_admin", methods={"GET"})
     */
    public function index(EventRepository $eventRepository, RepresentationRepository $representationRepository): Response
    {

        return $this->render('event/index_admin.html.twig', [
            'events' => $eventRepository->findAll(),
            'representations' => $representationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $event->setUpdatedAt(new \DateTime());
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Spectacle ajouté avec succès');


            return $this->redirectToRoute('event_index_admin');
        }

        return $this->render('event/new_admin.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show_admin", methods={"GET"})
     */
    public function show(Event $event, RepresentationRepository $representationRepository): Response
    {
        $id = $event->getId();

        return $this->render('event/show_admin.html.twig', [
            'event' => $event,
            'representations' => $representationRepository->findDateFromNow($id),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Spectacle modifié avec succès');


            return $this->redirectToRoute('event_index_admin');
        }

        return $this->render('event/edit_admin.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();

            $this->addFlash('danger', 'Spectacle supprimé avec succès');

        }

        return $this->redirectToRoute('event_index_admin');
    }
}
