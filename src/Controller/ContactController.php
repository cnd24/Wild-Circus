<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer)
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $message = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($contact->getEmail())
                ->subject('Demande de contact')
                ->html($this->renderView('contact/success.html.twig', [
                    'message' => $contact->getMessage(),
                ]));
            $mailer->send($message);
            $this->addFlash(
                'success', "Votre e-mail a bien été pris en compte, vous recevrez une réponse rapidement."
            );
            return $this->redirectToRoute("home");
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}