<?php

namespace App\Controller\Website;

use App\Entity\Contact;
use App\Form\Type\ContactFormType;
use App\Manager\ContentRespositoryManager;
use App\Manager\MailManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function page(Request $request, ContentRespositoryManager $crm, MailManager $mm)
    {
        $hideForm = false;
        $showError = false;
        $page = $crm->findPage('contacte');
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hideForm = true;
            $showError = $mm->sendCmsAdminEmailNotification($contact) ? false : true;
        }

        return $this->render('contactform.html.twig', [
            'hide_form' => $hideForm,
            'show_error' => $showError,
            'form' => $form->createView(),
            'page' => $page,
            'template' => 'contact',
            'content' => [
                'url' => '/contacte',
            ]
        ]);
    }
}
