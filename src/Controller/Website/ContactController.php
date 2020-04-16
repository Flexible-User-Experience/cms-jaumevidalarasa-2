<?php

namespace App\Controller\Website;

use App\Entity\Contact;
use App\Form\Type\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function page(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO perform mail notification
        }

        return $this->render('contactform.html.twig', [
            'form' => $form->createView(),
            'template' => 'contact',
            'content' => [
                'url' => '/contacte',
            ]
        ]);
    }
}
