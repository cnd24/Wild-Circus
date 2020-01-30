<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Form\RepresentationType;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/representation")
 */
class RepresentationAdminController extends AbstractController
{
    /**
     * @Route("/", name="representation_index_admin", methods={"GET"})
     */
    public function index(RepresentationRepository $representationRepository): Response
    {
        return $this->render('representation/index_admin.html.twig', [
            'representations' => $representationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="representation_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $representation = new Representation();
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($representation);
            $entityManager->flush();

            $this->addFlash('success', 'Représentation ajoutée avec succès');


            return $this->redirectToRoute('representation_index_admin');
        }

        return $this->render('representation/new_admin.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="representation_show_admin", methods={"GET"})
     */
    public function show(Representation $representation): Response
    {
        return $this->render('representation/show_admin.html.twig', [
            'representation' => $representation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="representation_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Representation $representation): Response
    {
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Représentation modifiée avec succès');


            return $this->redirectToRoute('representation_index_admin');
        }

        return $this->render('representation/edit_admin.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="representation_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Representation $representation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$representation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($representation);
            $entityManager->flush();

            $this->addFlash('danger', 'Représentation supprimée avec succès');

        }

        return $this->redirectToRoute('representation_index_admin');
    }
}
