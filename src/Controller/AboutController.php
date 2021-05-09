<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about", methods={"GET"})
     */
    public function about(Request $request, ContactNotification $notification){
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'votre mail a bien été envoyé, nous vous répondrons dans 
            les plus brefs délais');

        }
        return $this->render('GuyNwogang/about.html.twig', [
            'form' => $form->createView()
        ]);

    }



    /**
     * @Route("/contact", name="app_contact")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(Request $request, ContactNotification $notification){
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'votre mail a bien été envoyé, nous vous répondrons dans 
            les plus brefs délais');

        }

        return $this->render('GuyNwogang/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

}

