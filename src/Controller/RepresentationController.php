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
 * @Route("/representation")
 */
class RepresentationController extends AbstractController
{
    /**
     * @Route("/", name="representation_index", methods={"GET"})
     */
    public function index(RepresentationRepository $representationRepository): Response
    {
        return $this->render('representation/index.html.twig', [
            'representations' => $representationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="representation_show", methods={"GET"})
     */
    public function show(Representation $representation): Response
    {
        return $this->render('representation/show.html.twig', [
            'representation' => $representation,
        ]);
    }

}
